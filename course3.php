<?php
session_start();

    include("connection.php");
    include("functions.php");

    $user_data = check_login($con);

    if($user_data) {
      if ($user_data['user_role'] == 'designer') {
          return header('Location: index-designer.php');
      } else if ($user_data['user_role'] == 'admin') {
        return header('Location: index-admin.php');
      }
    } else {
        header('Location: index-guest.php');
    }

    $all_designers_query = "select * from users where user_role = 'designer'";
    $all_designers = mysqli_query($con, $all_designers_query);
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
              <li><a href="my-requests.php">My Requests</a></li>
              <li class="active"><a href="courses.php">Courses</a></li>
              <li><a href="#">Hello: <?php echo $user_data['user_name'] ?></a></li>
            </ul>
          </nav><!-- .nav-menu -->

          <a href="logout.php" class="get-started-btn scrollto">Logout</a>
        </div>
      </div>

    </div>
  </header><!-- End Header -->

  <section style="margin-top: 50px;">
    <div class="container mt-3"><br>
    <form method="post">
        <h3>Course 3: Fashion Draping-Basics online course by Elena Ryleeva: </h3>

        <h4 style="color: #e03a3c;">(7 videos) - ($150)</h4><br><br>

        <?php
          if($_SERVER['REQUEST_METHOD'] == "POST") {
            $get_money_query = "select * from users where user_role = 'admin'";
            $get_money = mysqli_query($con, $get_money_query);
    
            if($get_money && mysqli_num_rows($get_money) > 0) {
              $current_money = mysqli_fetch_assoc($get_money);
              $updated_money = $current_money['money'] + 150;
  
              $add_money_query = "update users set money = '$updated_money' where user_role = 'admin'";
              $add_money = mysqli_query($con, $add_money_query);
  
              if($add_money) {
                $client_id = $user_data['id'];
      
                $query = "insert into courses (client_id,course_num) values ('$client_id',3)";
                $result = mysqli_query($con, $query);
          
                if($result) {
                  header('Location: course3-data.php');
                } else {
                  echo "failed to purchase the course";
                }
              }
            } 
            
          }
        ?>

        <h5>- Video 1: Introduction to Fashion Draping-Basics online course</h5>
        <h5>- Video 2: Draping Convertible Collar</h5>
        <h5>- Video 3: Short overview of Fashion Draping-Basics course</h5>
        <h5>- Video 4: Basic skirt: Marking the darts on the front</h5>
        <h5>- Video 5: Verifying Basic bodice</h5>
        <h5>- Video 6: Princess bodice: draping back center panel</h5>
        <h5>- Video 7: Shift dress draping: preparing front fabric piece</h5>

        <div class="text-center mt-4">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">enroll this course</button>
            <a href="courses.php" class="btn btn-warning">back to courses</a>
        </div>

        <!-- The Modal -->
        <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Enroll Course 3: Fashion Draping-Basics online course by Elena Ryleeva ($150)</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
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
                        <!-- <input type="submit" class="btn btn-primary m-auto" value="Enroll Now"> -->
                        <button type="submit" class="btn btn-primary m-auto">Enroll Now</button>
                    </div>
                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

            </div>
        </div>
        </div>
        </form>
    </div>
    </section>

  

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