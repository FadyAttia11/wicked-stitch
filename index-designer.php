<?php
session_start();

    include("connection.php");
    include("functions.php");

    $user_data = check_login($con);
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
              <li class="active"><a href="#header">Home</a></li>
              <li><a href="requests.php">Unanswered Requests</a></li>
              <li><a href="answered-requests.php">Answered Requests</a></li>
              <li><a href="#">Hello: <?php echo $user_data['user_name'] ?></a></li>
            </ul>
          </nav><!-- .nav-menu -->

          <a href="logout.php" class="get-started-btn scrollto">Logout</a>
        </div>
      </div>

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">

    <div class="container-fluid" data-aos="zoom-out" data-aos-delay="100">
      <div class="row justify-content-center">
        <div class="col-xl-10">
          <div class="row">
            <div class="col-xl-5">
              <h1>The Link Between Fashion Designers and Clients</h1>
              <h2>Tailor Clothes and buy from the store with our easy approaches</h2>
              <a href="requests.php" class="btn-get-started scrollto">Answer Requests</a>
            </div>
          </div>
        </div>
      </div>
    </div>

  </section><!-- End Hero -->

  <main id="main">

    

    <!-- ======= About Section ======= -->
    <section id="about" class="about section-bg">
      <div class="container" data-aos="fade-up">

        <div class="row no-gutters">
          <div class="content col-xl-5 d-flex align-items-stretch">
            <div class="content">
              <h3>Clients Connected To Fashion Designers</h3>
              <p>
                with the way we do things it's never been easier to connect to a fashion designer and ask him 
                to tailor clothes for you and choose wheather you accept his pricing or not.
              </p>
              <a href="signup.php" class="about-btn"><span>Sign Up</span> <i class="bx bx-chevron-right"></i></a>
            </div>
          </div>
          <div class="col-xl-7 d-flex align-items-stretch">
            <div class="icon-boxes d-flex flex-column justify-content-center">
              <div class="row">
                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="100">
                  <i class="bx bx-receipt"></i>
                  <h4>Buy from the Store</h4>
                  <p>Buy whatever you like from the store we provide with a lot of different brands available.</p>
                </div>
                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="200">
                  <i class="bx bx-cube-alt"></i>
                  <h4>Ask Designers for Clothes</h4>
                  <p>ask designers for tailoring clothes to wear what really represents you and make you shine.</p>
                </div>
                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="300">
                  <i class="bx bx-images"></i>
                  <h4>Respond to the Designer Pricing</h4>
                  <p>respond to designer pricing wheather you accept it or decline it.</p>
                </div>
                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="400">
                  <i class="bx bx-shield"></i>
                  <h4>Watch Our Design Courses</h4>
                  <p>watch our various design courses to learn fashion and design yourself.</p>
                </div>
              </div>
            </div><!-- End .content-->
          </div>
        </div>

      </div>
    </section><!-- End About Section -->

    <!-- ======= Tabs Section ======= -->
    <section id="tabs" class="tabs">
      <div class="container" data-aos="fade-up">

        <ul class="nav nav-tabs row d-flex">
          <li class="nav-item col-3">
            <a class="nav-link active show" data-toggle="tab" href="#tab-1">
              <i class="ri-gps-line"></i>
              <h4 class="d-none d-lg-block">Buy from the Store</h4>
            </a>
          </li>
          <li class="nav-item col-3">
            <a class="nav-link" data-toggle="tab" href="#tab-2">
              <i class="ri-body-scan-line"></i>
              <h4 class="d-none d-lg-block">Ask Designers for Clothes</h4>
            </a>
          </li>
          <li class="nav-item col-3">
            <a class="nav-link" data-toggle="tab" href="#tab-3">
              <i class="ri-sun-line"></i>
              <h4 class="d-none d-lg-block">Respond to the Designer Pricing</h4>
            </a>
          </li>
          <li class="nav-item col-3">
            <a class="nav-link" data-toggle="tab" href="#tab-4">
              <i class="ri-store-line"></i>
              <h4 class="d-none d-lg-block">Watch Our Design Courses</h4>
            </a>
          </li>
        </ul>

        <div class="tab-content">
          <div class="tab-pane active show" id="tab-1">
            <div class="row">
              <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0" data-aos="fade-up" data-aos-delay="100">
                <h3>Buy from the store whatever you like from various available brands.</h3>
                <p class="font-italic">
                  Choose from our collection whatever you think it's the best for you. and get clothes from a lot 
                  of well-known brands.
                </p>
                <ul>
                  <li><i class="ri-check-double-line"></i> Immediate Buy from the store.</li>
                  <li><i class="ri-check-double-line"></i> Delivery time is minimized to get you the clothes quickly.</li>
                  <li><i class="ri-check-double-line"></i> our returning policy is flexible, so don't worry about different sizes.</li>
                </ul>
                <p>
                  With our store. it's never been easier to navigate between clothes from different brands to get whatever you really like, 
                  and whatever makes you shine and makes you unique. the purchasing process is very easy and quick and you can start now to 
                  buy the clothes that you prefer.
                </p>
              </div>
              <div class="col-lg-6 order-1 order-lg-2 text-center" data-aos="fade-up" data-aos-delay="200">
                <img src="assets/img/tabs-1.jpg" alt="" class="img-fluid">
              </div>
            </div>
          </div>
          <div class="tab-pane" id="tab-2">
            <div class="row">
              <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0">
                <h3>Ask Designer to Tailor the clothes you want and get exactly what you are asking for</h3>
                <p>
                  With our various taste of tailors. you can choose from them the one you like and start asking him to tailor clothes for you. 
                  you can wait for them to hear exactly about what you are asking about and you can contact several tailors about several designs 
                  at the same time.
                </p>
                <ul>
                  <li><i class="ri-check-double-line"></i> Easy to communicate with the tailors.</li>
                  <li><i class="ri-check-double-line"></i> Ask about anything you want not just specific things.</li>
                  <li><i class="ri-check-double-line"></i> it's free to send as many requests to tailors as you want.</li>
                  <li><i class="ri-check-double-line"></i> it's completely safe and secure and the chat between you nobody see even the admins.</li>
                </ul>
              </div>
              <div class="col-lg-6 order-1 order-lg-2 text-center">
                <img src="assets/img/tabs-2.jpg" alt="" class="img-fluid">
              </div>
            </div>
          </div>
          <div class="tab-pane" id="tab-3">
            <div class="row">
              <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0">
                <h3>Accept or Decline The Pricing the the Designer Determine</h3>
                <p>
                  after you ask for a specific piece of clothes from a tailor. it's compeletly up to you to accept or refuse the offer that 
                  he gives you. if you accept his offer you will be able to see his phone number and you will be able to contact him to give 
                  you the piece of clothes you asked for.
                </p>
                <ul>
                  <li><i class="ri-check-double-line"></i> Accept or Decline designer offer.</li>
                  <li><i class="ri-check-double-line"></i> when the offer is accepted, the designer phone is shown to you.</li>
                  <li><i class="ri-check-double-line"></i> it's okay to decline as many offers as you want, that's fair.</li>
                </ul>
                <p class="font-italic">
                  with this is mind, it becomes relatively easy to ask for whatever you want and don't be afraid from pricing. it's okay you 
                  can know the price now and buy later.
                </p>
              </div>
              <div class="col-lg-6 order-1 order-lg-2 text-center">
                <img src="assets/img/tabs-3.jpg" alt="" class="img-fluid">
              </div>
            </div>
          </div>
          <div class="tab-pane" id="tab-4">
            <div class="row">
              <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0">
                <h3>Watch Our Design Courses to learn fashion and design yourself</h3>
                <p>
                  With the design courses we offer you can learn from a lot of very talented designers the principles of designing clothes and 
                  fashion in general to grasp these concepts and be able to make the designs by yourself. the courses are offered with fair 
                  prices and you can check the content before payment.
                </p>
                <p class="font-italic">
                  Check the content of the courses. pick the one that you like. pay with your credit card and start your learning journey now. 
                  that's all you have to do to become a great designer.
                </p>
                <ul>
                  <li><i class="ri-check-double-line"></i> Choose from the courses we offer.</li>
                  <li><i class="ri-check-double-line"></i> Pay for the course that you like it's content.</li>
                  <li><i class="ri-check-double-line"></i> become a great designer after finishing as many courses as you can and start design your own clothes now.</li>
                </ul>
              </div>
              <div class="col-lg-6 order-1 order-lg-2 text-center">
                <img src="assets/img/tabs-4.jpg" alt="" class="img-fluid">
              </div>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End Tabs Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg ">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Services</h2>
          <p>We offer you a different variants of services to make sure that we can make you happy and we can give you the things that you are looking for.</p>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
              <i class="icofont-computer"></i>
              <h4><a href="#">Clothes Store</a></h4>
              <p>on our clothes store you can search for anything you like and get the clothes you want the fatest way possible.</p>
            </div>
          </div>
          <div class="col-md-6 mt-4 mt-md-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
              <i class="icofont-chart-bar-graph"></i>
              <h4><a href="#">Various Brands</a></h4>
              <p>from our various brands like adidas, nike, zara, and calvin klein you can choose your preferable brand. </p>
            </div>
          </div>
          <div class="col-md-6 mt-4 mt-md-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="300">
              <i class="icofont-image"></i>
              <h4><a href="#">Tailor Clothes</a></h4>
              <p>you can hire a fashion designer to tailor the clothes for you and you can get exactly what you are looking for.</p>
            </div>
          </div>
          <div class="col-md-6 mt-4 mt-md-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="400">
              <i class="icofont-settings"></i>
              <h4><a href="#">Earn Money as Designer</a></h4>
              <p>you can earn money as a designer by submitting offers to clients with reasonable amount of money to do their jobs.</p>
            </div>
          </div>
          <div class="col-md-6 mt-4 mt-md-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="500">
              <i class="icofont-earth"></i>
              <h4><a href="#">Watch Online Courses</a></h4>
              <p>you can watch online courses to get the most out of your learning and start your career as a designer.</p>
            </div>
          </div>
          <div class="col-md-6 mt-4 mt-md-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="600">
              <i class="icofont-tasks-alt"></i>
              <h4><a href="#">Wear What you Prefer</a></h4>
              <p>you can wear whatever you prefer from the collection of clothes available on our store and with our designers.</p>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End Services Section -->

   


    <!-- ======= Frequently Asked Questions Section ======= -->
    <section id="faq" class="faq">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Frequently Asked Questions</h2>
        </div>

        <ul class="faq-list" data-aos="fade-up">

          <li>
            <a data-toggle="collapse" class="collapsed" href="#faq1">What is the benefit of your store? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-x icon-close"></i></a>
            <div id="faq1" class="collapse" data-parent=".faq-list">
              <p>
                you can use our store to buy clothes the fastest possible way without too much thinking about actually designing the clothes.
              </p>
            </div>
          </li>

          <li>
            <a data-toggle="collapse" href="#faq2" class="collapsed">What are the brands on your store? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-x icon-close"></i></a>
            <div id="faq2" class="collapse" data-parent=".faq-list">
              <p>
                A lot of brands like nike, adidas, zara, and calvin klein and there is an opportunity to contract with others later on.
              </p>
            </div>
          </li>

          <li>
            <a data-toggle="collapse" href="#faq3" class="collapsed">How can i contact the fashion designers? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-x icon-close"></i></a>
            <div id="faq3" class="collapse" data-parent=".faq-list">
              <p>
                you can go to all designers page and look for the designer you want to contact and just leave him a message with what you want.
              </p>
            </div>
          </li>

          <li>
            <a data-toggle="collapse" href="#faq4" class="collapsed">Am i allowed to decline the offer that the designer gives me? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-x icon-close"></i></a>
            <div id="faq4" class="collapse" data-parent=".faq-list">
              <p>
                of course you are, you are allowed to accept or decline any offer from the designers.
              </p>
            </div>
          </li>

          <li>
            <a data-toggle="collapse" href="#faq5" class="collapsed">what is the advantages of your courses? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-x icon-close"></i></a>
            <div id="faq5" class="collapse" data-parent=".faq-list">
              <p>
                our courses is made specifically to help people learn fashion and design. so if you are starting out make sure to check our courses.
              </p>
            </div>
          </li>

          <li>
            <a data-toggle="collapse" href="#faq6" class="collapsed">Are your courses worth investing the money on? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-x icon-close"></i></a>
            <div id="faq6" class="collapse" data-parent=".faq-list">
              <p>
                of course they are. they are a specific set of courses made only to give you a boost in your career as a designer.
              </p>
            </div>
          </li>

        </ul>

      </div>
    </section><!-- End Frequently Asked Questions Section -->
  </main><!-- End #main -->

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
              <strong>Phone:</strong> 0100 253 6648<br>
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
              <li><i class="bx bx-chevron-right"></i> <a href="#">Our Store</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">All Designers</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Contact Designer</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Our Courses</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Become a Designer</a></li>
            </ul>
          </div>

          <div class="col-lg-4 col-md-6 footer-newsletter">
            <h4>Join Our Newsletter</h4>
            <p>Join Our Newsletter to never miss anything related to the clothes community and be part of it.</p>
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