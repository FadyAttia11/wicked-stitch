<?php
session_start();

    include("connection.php");
    include("functions.php");

    $user_data = check_login($con);

    $all_purchased_query = "select * from purchased";
    $all_purchased = mysqli_query($con, $all_purchased_query);
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
              <li><a href="new-store.php">Add To Store</a></li>
              <li class="active"><a href="all-purchased.php">See All Purchased</a></li>
              <li><a href="#">Hello: <?php echo $user_data['user_name'] ?></a></li>
            </ul>
          </nav><!-- .nav-menu -->

          <a href="logout.php" class="get-started-btn scrollto">Logout</a>
        </div>
      </div>

    </div>
  </header><!-- End Header -->

    <section style="margin-top: 100px;">
    <div class="container mt-3">
        <h3>SEE ALL PURCHASED ITEMS</h3>
        <p>Your Have: $<?php echo $user_data['money'] ?></p>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Product Name</th>
                <th>Price</th>
                <th>Client Name</th>
                <th>Drop-off Location</th>
                <th>Drop-off Time</th>
                <th>Date</th>
            </tr>
            </thead>
            <tbody>
            <?php
                while($row = mysqli_fetch_array($all_purchased)) {
            ?>
                <tr>
                    <td><?php echo $row['product_title'] ?></td>
                    <td><?php echo $row['price'] ?></td>
                    <td><?php echo $row['client_name'] ?></td>
                    <td><?php echo $row['location'] ?></td>
                    <td><?php echo $row['day'] ?></td>
                    <td><?php echo $row['date'] ?></td>
                </tr>

            <?php } ?>
            </tbody>
        </table>
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