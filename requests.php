<?php
session_start();

    include("connection.php");
    include("functions.php");

    $user_data = check_login($con);
    $user_id = $user_data['id'];
    $user_name = $user_data['user_name'];

    if($user_data) {
      if ($user_data['user_role'] == 'client') {
          return header('Location: index-client.php');
      } else if ($user_data['user_role'] == 'admin') {
        return header('Location: index-admin.php');
      }
    } else {
        header('Location: index-guest.php');
    }

    $designer_requests = "select * from requests where designer_id = '$user_id' and price = ''";
    $designer_requests = mysqli_query($con, $designer_requests);
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
              <li class="active"><a href="requests.php">Unanswered Requests</a></li>
              <li><a href="answered-requests.php">Answered Requests</a></li>
              <li><a href="#">Hello: <?php echo $user_data['user_name'] ?></a></li>
            </ul>
          </nav><!-- .nav-menu -->

          <a href="logout.php" class="get-started-btn scrollto">Logout</a>
        </div>
      </div>

    </div>
  </header><!-- End Header -->

  <!-- Page Content -->
  <div class="container">

    <div class="row">

      
      <!-- /.col-lg-3 -->

      <div class="col-lg-12"  style="margin-top: 100px;">

        <h1>UnAnswered User Requests</h1>  

        <?php
          if($_SERVER['REQUEST_METHOD'] == "POST") {
            $request_id = $_POST['request_id'];
            $price = $_POST['price'];

            $add_price_query = "update requests set price = '$price', state = 'pending' where id = '$request_id'";
            $add_price = mysqli_query($con, $add_price_query);

            if($add_price) {
              header('Location: answered-requests.php');
              echo "successfully added the price for the client request";
            } else {
              echo "error adding the price for the client request";
            }
          }
        ?>

        <div class="row">

        <?php
            while($row = mysqli_fetch_array($designer_requests)) {
          ?>

          <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
              <div class="card-body">
              <?php 
                if($row['image'] != '') {
              ?>
              <img class='card-img-top mb-3' src=<?php echo "uploads/". $row['image'] ?> alt='Profile Picture' style='width:100%'>
              <?php } ?>
                <h4 class="card-title">
                  <a href="#">Client Name: <?php echo $row['client_name'] ?></a>
                </h4>
                <!-- <h5>$24.99</h5> -->
                <p class="card-text">Details: <?php echo $row['details'] ?></p>
                <form method="post">
                  <div class="form-group">
                    <input type="hidden" name="request_id" value=<?php echo $row['id'] ?>>
                    <input class="form-control" type="number" placeholder="Enter Your Price" name="price">
                  </div>
                  <div class="form-group">
                    <input class="btn btn-primary" type="submit" value="Submit Price" style="background: #e03a3c;">
                  </div>
                </form>
              </div>
              <div class="card-footer">
                <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
              </div>
            </div>
          </div>

          
          <?php } ?>
          

        </div>
        <!-- /.row -->

      </div>
      <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  

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