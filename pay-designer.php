<?php
session_start();

    include("connection.php");
    include("functions.php");

    $user_data = check_login($con);
    $user_name = $user_data['user_name'];
    $request_id = $_GET["id"];

    if($user_data) {
      if ($user_data['user_role'] == 'designer') {
          return header('Location: index-designer.php');
      } else if ($user_data['user_role'] == 'admin') {
        return header('Location: index-admin.php');
      }
    } else {
        header('Location: index-guest.php');
    }

    $product_info_query = "select * from requests where id = '$request_id'";
    $product_info = mysqli_query($con, $product_info_query);
    if($product_info) {
        $current_product = mysqli_fetch_assoc($product_info);
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
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
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
              <li><a href="store.php">Our Store</a></li>
              <li><a href="designers.php">Fasion Designers</a></li>
              <li class="active"><a href="my-requests.php">My Requests</a></li>
              <li><a href="courses.php">Courses</a></li>
              <li><a href="#">Hello: <?php echo $user_data['user_name'] ?></a></li>
            </ul>
          </nav><!-- .nav-menu -->

          <a href="logout.php" class="get-started-btn scrollto">Logout</a>
        </div>
      </div>

    </div>
  </header><!-- End Header -->

  <!-- Page Content -->
  <div class="container mb-5" style="max-width: 400px; margin-top: 100px;">
    <h1>Checkout</h1>
    <?php
        if($_SERVER['REQUEST_METHOD'] == "POST") {

            $get_money_query = "select * from users where user_role = 'admin'";
            $get_money = mysqli_query($con, $get_money_query);
    
            if($get_money && mysqli_num_rows($get_money) > 0) {
                
                $current_money = mysqli_fetch_assoc($get_money);
                $updated_money = $current_money['money'] + $current_product['price'];

                // echo "Successfully purchased your product";
    
                $add_money_query = "update users set money = '$updated_money' where user_role = 'admin'";
                $add_money = mysqli_query($con, $add_money_query);
    
                if($add_money) {
                    $update_state_query = "update requests set state = 'Client Accepted' where id = '$request_id'";
                    $update_state = mysqli_query($con, $update_state_query);

                    if($update_state) {
                        header('Location: my-requests.php');
                    }
                } else {
                    echo "error adding money to our account";
                }
            }
        }
    ?>

    <form method="post" class="m-auto">
        <div class="form-group mt-2">
            <label>Card holder's name</label>
        <input type="text" placeholder="Card holder's name" class="form-control">
        </div>
        <div class="form-group">
        <label>Card number</label>
        <input type="number" placeholder="Card number" class="form-control">
        </div>
        <div class="form-group">
            <label>Expire Date</label>
            <input type="date" placeholder="dd/mm/yy" class="form-control">
        </div>
        <div class="form-group">
            <label>CVV</label>
            <input type="text" placeholder="CVV" class="form-control">
        </div>
        <div class="text-center">
            <input type="submit" class="btn btn-primary m-auto" value="Buy Item">
        </div>
    </form>

  </div>
  <!-- /.container -->

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>Wicked Stitch<span>.</span></h3>
            <p>
              El Maadi <br>
              Cairo, EG<br>
              Egypt <br><br>
              <strong>Phone:</strong> +1 5589 55488 55<br>
              <strong>Email:</strong> info@example.com<br>
            </p>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Services</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
            </ul>
          </div>

          <div class="col-lg-4 col-md-6 footer-newsletter">
            <h4>Join Our Newsletter</h4>
            <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
            <form action="" method="post">
              <input type="email" name="email"><input type="submit" value="Subscribe">
            </form>
          </div>

        </div>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="assets/vendor/counterup/counterup.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/venobox/venobox.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>