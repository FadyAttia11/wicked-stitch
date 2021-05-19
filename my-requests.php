<?php
session_start();

    include("connection.php");
    include("functions.php");

    $user_data = check_login($con);
    $user_id = $user_data['id'];
    $user_name = $user_data['user_name'];

    if($user_data) {
      if ($user_data['user_role'] == 'designer') {
          return header('Location: index-designer.php');
      } else if ($user_data['user_role'] == 'admin') {
        return header('Location: index-admin.php');
      }
    } else {
        header('Location: index-guest.php');
    }

    $client_requests_query = "select * from requests where client_id = '$user_id' and price != '' and state = 'pending'";
    $client_requests = mysqli_query($con, $client_requests_query);

    $accepted_requests_query = "select * from requests where client_id = '$user_id' and price != '' and state = 'Client Accepted'";
    $accepted_requests = mysqli_query($con, $accepted_requests_query);
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
  <div class="container">

    <div class="row">

      
      <!-- /.col-lg-3 -->

      <div class="col-lg-12"  style="margin-top: 100px;">

        <h1>My Requests</h1>  

        <?php
          if($_SERVER['REQUEST_METHOD'] == "POST") {
            if(isset($_POST['accept'])) {
                $state = $_POST['accept'];
                $request_id = $_POST['request_id'];

                $update_state_query = "update requests set state = '$state' where id = '$request_id'";
                $update_state = mysqli_query($con, $update_state_query);

                if($update_state) {
                    header('Location: my-requests.php');
                } else {
                    echo "failed to update the state of your request";
                }
            } else if(isset($_POST['decline'])) {
                $state = $_POST['decline'];
                $request_id = $_POST['request_id'];

                $update_state_query = "update requests set state = '$state' where id = '$request_id'";
                $update_state = mysqli_query($con, $update_state_query);

                if($update_state) {
                    header('Location: my-requests.php');
                } else {
                    echo "failed to update the state of your request";
                }
            }
          }
        ?>

        <div class="row">

        <?php
            while($row = mysqli_fetch_array($client_requests)) {
          ?>

          <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
              <div class="card-body">
                <h4 class="card-title">
                  <a href="#">Designer Name: <?php echo $row['designer_name'] ?></a>
                </h4>
                <!-- <h5>$24.99</h5> -->
                <p class="card-text">My Details: <?php echo $row['details'] ?></p>
                
                <h5>Designer Price: $<?php echo $row['price'] ?></h5>

                <h5>State: <?php echo $row['state'] ?></h5>
                  
                
              </div>
              <div class="card-footer">
              <a href=<?php echo "pay-designer.php?id=". $row['id'] ?> class="btn btn-primary">Accept</a>
                <!-- <form method="post">
                    <input type="hidden" name="accept" value="Client Accepted">
                    <input type="hidden" name="request_id" value=>
                    <input type="submit" class="btn btn-primary" value="Accept">
                </form> -->
                <form method="post">
                    <input type="hidden" name="decline" value="Client Declined">
                    <input type="hidden" name="request_id" value=<?php echo $row['id'] ?>>
                    <input type="submit" class="btn btn-danger mt-2" value="Delete">
                </form>
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

    <div class="row">

      
      <!-- /.col-lg-3 -->

      <div class="col-lg-12"  style="margin-top: 100px;">

        <h1>Accepted Requests</h1>  

        <?php
          if($_SERVER['REQUEST_METHOD'] == "POST") {
            if(isset($_POST['accept'])) {
                $state = $_POST['accept'];

                $query = "update users where email = '$email' limit 1";
                $result = mysqli_query($con, $query);
            }
          }
        ?>

        <div class="row">

        <?php
            while($row = mysqli_fetch_array($accepted_requests)) {
          ?>

          <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
              <div class="card-body">
                <h4 class="card-title">
                  <a href="#">Designer Name: <?php echo $row['designer_name'] ?></a>
                </h4>
                <!-- <h5>$24.99</h5> -->
                <p class="card-text">My Details: <?php echo $row['details'] ?></p>
                
                <h5>Designer Price: $<?php echo $row['price'] ?></h5>

                <h5>State: <?php echo $row['state'] ?></h5>
                  
                
              </div>
              <div class="card-footer">
                <h6>Designer Phone: 0<?php echo $row['designer_phone'] ?></h6>
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