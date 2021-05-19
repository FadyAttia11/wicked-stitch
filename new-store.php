<?php
session_start();

    include("connection.php");
    include("functions.php");

    $user_data = check_login($con);

    $error_msg = "";
    $profile_pic = "";

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        //something was posted
        $name = $_POST['name'];
        $price = $_POST['price'];
        $brand = $_POST['brand'];
        $description = $_POST['description'];

        $target_dir = "uploads/";
        $target_file = $target_dir . time() . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                $error_msg = "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                $error_msg = "File is not an image.";
                $uploadOk = 0;
            }
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
            $error_msg = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $error_msg = "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
            } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $profile_pic = time() . basename($_FILES["fileToUpload"]["name"]);
                // echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
            } else {
                $error_msg = "Sorry, there was an error uploading your file.";
            }
        }
        
        if(!empty($name) && !empty($price) && !empty($brand) && !empty($description)) {
            //save to database
            $add_to_store_query = "insert into store (title,description,brand,price,image) values ('$name','$description', '$brand','$price','$profile_pic')";
            $add_to_store = mysqli_query($con, $add_to_store_query);

            if($add_to_store) {
                $error_msg =  "Successfully added the item to the store";
            } else {
                $error_msg =  "Error adding the item to the store!";
            }
        } else {
                $error_msg =  "Please enter some valid information";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Wicked Stitch</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,700,700i&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

</head>
<body>
   

  <!-- ======= Header ======= -->
 <header id="header" class="fixed-top">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-xl-10 d-flex align-items-center">
          <h1 class="logo mr-auto"><a href="index.php">Wicked Stitch<span>.</span></a></h1>

          <nav class="nav-menu d-none d-lg-block">
            <ul>
              <li><a href="index.php">Home</a></li>
              <li class="active"><a href="new-store.php">Add To Store</a></li>
              <li><a href="all-purchased.php">See All Purchased</a></li>
              <li><a href="#">Hello: <?php echo $user_data['user_name'] ?></a></li>
            </ul>
          </nav><!-- .nav-menu -->

          <a href="logout.php" class="get-started-btn scrollto">Logout</a>
        </div>
      </div>

    </div>
  </header><!-- End Header -->

    <section style="margin-top: 100px;">
    <div class="container mt-3" style="max-width: 700px;">
        <h3>ADD NEW ITEM TO THE STORE</h3>
        <form method="post" class="needs-validation" enctype="multipart/form-data" novalidate>
        <div class="row mb-3">
        <div class="col">
            <input type="text" class="form-control" id="name" placeholder="Item Name" name="name" required>
        </div>
        <div class="col">
            <input type="number" class="form-control" placeholder="Price" name="price" required>
        </div>
        </div>
        <div class="form-group">
            <label for="sel1">Choose the brand:</label>
            <select class="form-control" id="brand" name="brand">
                <option>Nike</option>
                <option>Adidas</option>
                <option>Zara</option>
                <option>Calvin Klein</option>
            </select>
        </div>

        <textarea class="form-control mb-4" rows="5" name="description" placeholder="write a description for your product.."></textarea>
        
        
        <label>Product Image (Required):</label>
        <input type="file" class="form-control file_height" name="fileToUpload" required>
        

        <button type="submit" class="btn btn-primary mt-4" style="background: #e03a3c;">Add New Product</button>
        <?php echo $error_msg ?>
        </form>
    </div>
    </section>

    <script>
        // Disable form submissions if there are invalid fields
        (function() {
            'use strict';
            window.addEventListener('load', function() {
            // Get the forms we want to add validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
                }, false);
            });
            }, false);
        })();
    </script>
</body>
</html>