<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Phoneku</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="/assets/dashboard/assets/img/favicon.png" rel="icon">
  <link href="/assets/dashboard/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Krub:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="/assets/dashboard/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="/assets/dashboard/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/assets/dashboard/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="/assets/dashboard/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="/assets/dashboard/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="/assets/dashboard/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="/assets/dashboard/assets/css/style.css" rel="stylesheet">
  <script src="https://unpkg.com/feather-icons"></script>

  <!-- =======================================================
  * Template Name: Bikin - v4.3.0
  * Template URL: https://bootstrapmade.com/bikin-free-simple-landing-page-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center justify-content-between">

      <h1 class="logo"><a href="/">Phoneku</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo"><img src="/assets/dashboard/assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="/#">Home</a></li>
          <li><a class="nav-link scrollto" href="/#about">About</a></li>
          <li><a class="nav-link scrollto" href="/#mrk">Merek</a></li>
          <li><a class="nav-link scrollto " href="/#partner">Toko</a></li>
          <li><a class="nav-link scrollto " href="/#portfolio">Portfolio</a></li>
          <li><a class="nav-link scrollto" href="/#team">Team</a></li>
          <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="#">Drop Down 1</a></li>
              <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
                <ul>
                  <li><a href="#">Deep Drop Down 1</a></li>
                  <li><a href="#">Deep Drop Down 2</a></li>
                  <li><a href="#">Deep Drop Down 3</a></li>
                  <li><a href="#">Deep Drop Down 4</a></li>
                  <li><a href="#">Deep Drop Down 5</a></li>
                </ul>
              </li>
              <li><a href="#">Drop Down 2</a></li>
              <li><a href="#">Drop Down 3</a></li>
              <li><a href="#">Drop Down 4</a></li>
            </ul>
          </li>
          <li><a class="getstarted" href="/search">Search Smartphone</a></li>
          <li><a class="getstarted" href="/login">Login</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->
  <!--///////////////////////////////////////////////////////////////////////////////////////////////////-->
  <?= $this->renderSection('content_public'); ?>
  <!--///////////////////////////////////////////////////////////////////////////////////////////////////-->
  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="container d-md-flex py-4">

      <div class="me-md-auto text-center text-md-start">
        <div class="copyright">
          &copy; Copyright <strong><span>Bikin</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
          <!-- All the links in the footer should remain intact. -->
          <!-- You can delete the links only if you purchased the pro version. -->
          <!-- Licensing information: https://bootstrapmade.com/license/ -->
          <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/bikin-free-simple-landing-page-template/ -->
          Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
      </div>
      <div class="social-links text-center text-md-right pt-3 pt-md-0">
        <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
        <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
        <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
        <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
        <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="/assets/dashboard/assets/vendor/aos/aos.js"></script>
  <script src="/assets/dashboard/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/assets/dashboard/assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="/assets/dashboard/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="/assets/dashboard/assets/vendor/php-email-form/validate.js"></script>
  <script src="/assets/dashboard/assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Template Main JS File -->
  <script src="/assets/dashboard/assets/js/main.js"></script>
  <script>
    feather.replace()
  </script>

</body>

</html>