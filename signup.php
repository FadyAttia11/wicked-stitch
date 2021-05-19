<?php
session_start();

    include("connection.php");
    include("functions.php");

    $error_msg = "";
    $profile_pic = "";

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        //something was posted
        $user_name = $_POST['username'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $user_role = $_POST['user_role'];
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
        
        if(!empty($email) && !empty($password) && !empty($user_name) && !empty($phone) && !empty($user_role)) {
            //save to database
            $query = "insert into users (user_name,email,password,user_role,phone,description,image,money) values ('$user_name','$email', '$password','$user_role','$phone','$description','$profile_pic',0)";
            $result = mysqli_query($con, $query);

            if($result) {
                $_SESSION['user_id'] = $user_name;
                header('Location: index.php');
            } else {
                $error_msg =  "username is already taken!";
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
              <li><a href="#about">About</a></li>
              <li><a href="#tabs">Services</a></li>
              <li><a href="#services">Why us?</a></li>
              <li><a href="#faq">FAQ</a></li>
              <li><a href="signup.php">Signup</a></li>
            </ul>
          </nav><!-- .nav-menu -->

          <a href="login.php" class="get-started-btn scrollto">Login Now</a>
        </div>
      </div>

    </div>
  </header><!-- End Header -->

    <section style="margin-top: 100px;">
    <div class="container mt-3" style="max-width: 700px;">
        <h3>SIGN UP</h3>
        <form method="post" class="needs-validation" enctype="multipart/form-data" novalidate>
        <div class="row mb-3">
        <div class="col">
            <input type="text" class="form-control" id="username" placeholder="Username" name="username" required>
        </div>
        <div class="col">
            <input type="number" class="form-control" placeholder="Phone Number" name="phone" required>
        </div>
        </div>
        <div class="row mb-3">
        <div class="col">
            <input type="email" class="form-control" id="email" placeholder="Email" name="email" required>
        </div>
        <div class="col">
            <input type="password" class="form-control" placeholder="Password" name="password" required>
        </div>
        </div>

        <textarea class="form-control mb-4" rows="5" name="description" placeholder="write a description about yourself.."></textarea>
        
        
        <label>Profile Picture</label>
        <input type="file" class="form-control file_height" name="fileToUpload">
        
        
        <div class="form-check mb-1 mt-4">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="user_role" value="client">Client
            </label>
        </div>
        <div class="form-check mb-3">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="user_role" value="designer">Designer
            </label>
        </div>

        <button type="submit" class="btn btn-primary" style="background: #e03a3c;">Register</button>
        already have an account? <a href="login.php">login</a><br>
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