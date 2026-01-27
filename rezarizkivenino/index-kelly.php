<?php
include 'koneksi.php';
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM biodata ORDER BY id DESC LIMIT 1"));
$url_hero = !empty($data['url_hero']) ? 'uploads/hero/' . $data['url_hero'] : 'kelly-template/assets/img/hero-bg.jpg';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Index - Kelly Bootstrap Template</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <link href="kelly-template/assets/img/favicon.png" rel="icon">
  <link href="kelly-template/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Poppins:wght@400;600&display=swap" rel="stylesheet">

  <link href="kelly-template/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="kelly-template/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="kelly-template/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="kelly-template/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="kelly-template/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">

  <link href="kelly-template/assets/css/main.css" rel="stylesheet">

 <style>
  #hero {
    background-image: url('<?php echo $url_hero; ?>');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    min-height: 100vh;
  }

  #hero img {
    display: none;
  }
</style>
</head> 

<body class="index-page">
  <header id="header" class="header d-flex align-items-center light-background sticky-top">
    <div class="container-fluid position-relative d-flex align-items-center justify-content-between">
      <a href="index-kelly.php" class="logo d-flex align-items-center me-auto me-xl-0">
        <h1 class="sitename"><?php echo $data['nama_depan'] . ' ' . $data['nama_belakang']; ?></h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="index-kelly.php" class="active">Home</a></li>
          <li><a href="about.php">About</a></li>
          <li><a href="contact.php">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <div class="header-social-links">
        <a href="#" class="twitter"><i class="bi bi-twitter-x"></i></a>
        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
      </div>
    </div>
  </header>

  <main class="main">
    <section id="hero" class="hero section">
  <img src="<?php echo $url_hero; ?>" alt="Hero Background">
  <div class="container text-center" data-aos="zoom-out" data-aos-delay="100">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <h2><?php echo $data['nama_depan'] . ' ' . $data['nama_belakang']; ?></h2>
        <p>I'm a <?php echo $data['profesi']; ?> from <?php echo $data['kota']; ?></p>
        <a href="about.php" class="btn-get-started">About Me</a>
      </div>
    </div>
  </div>
</section>
  </main>

  <footer id="footer" class="footer light-background">
    <div class="container">
      <div class="copyright text-center ">
        <p>© <span>Copyright</span> <strong class="px-1 sitename">Kelly</strong> <span>All Rights Reserved<br></span></p>
      </div>
      <div class="social-links d-flex justify-content-center">
        <a href=""><i class="bi bi-twitter-x"></i></a>
        <a href=""><i class="bi bi-facebook"></i></a>
        <a href=""><i class="bi bi-instagram"></i></a>
        <a href=""><i class="bi bi-linkedin"></i></a>
      </div>
      <div class="credits">
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer>

  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <div id="preloader"></div>

  <script src="kelly-template/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="kelly-template/assets/vendor/php-email-form/validate.js"></script>
  <script src="kelly-template/assets/vendor/aos/aos.js"></script>
  <script src="kelly-template/assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="kelly-template/assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="kelly-template/assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="kelly-template/assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="kelly-template/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="kelly-template/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="kelly-template/assets/js/main.js"></script>
</body>

</html>
