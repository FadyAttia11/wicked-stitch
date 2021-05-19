<?php
session_start();

    include("connection.php");
    include("functions.php");
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
  <link rel="stylesheet" href="styles.css">

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
    <div class="container mt-3" style="max-width: 400px;"><br>
        <h3>LOGIN</h3>
        <form method="post" class="needs-validation" novalidate>
        
          <div class="form-group">
          <input type="email" class="form-control" id="email" placeholder="Email" name="email" required>
          </div>
          <div class="form-group">
          <input type="password" class="form-control" placeholder="Password" name="password" required>
          </div>
        
        <button type="submit" class="btn btn-primary" style="background: #e03a3c;">Login</button>
        dont have account yet? <a href="signup.php">signup</a>
        <?php
            if($_SERVER['REQUEST_METHOD'] == "POST") {
                //something was posted
                $email = $_POST['email'];
                $password = $_POST['password'];
        
                if(!empty($email) && !empty($password)) {
                    //read from database
                    $query = "select * from users where email = '$email' limit 1";
                    $result = mysqli_query($con, $query);
        
                    if($result) {
                        if($result && mysqli_num_rows($result) > 0) {
                            $user_data = mysqli_fetch_assoc($result);
                            if($user_data['password'] === $password) {
                                $_SESSION['user_id'] = $user_data['user_name'];
                                header('Location: index.php');
                                // if($user_data['user_role'] === 'freelancer') {
                                    
                                // } else if($user_data['user_role'] === 'client') {
                                //     header('Location: index-client.php');
                                // } else if($user_data['user_role'] === 'admin') {
                                //     header('Location: index-admin.php');
                                // }
                                die;
                            }
                        }
                    }
        
                    echo "Wrong username or password!";
                }else {
                    echo "Please enter some valid information!";
                }
            }
        ?>
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