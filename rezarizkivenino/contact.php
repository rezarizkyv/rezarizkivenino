<?php
include 'koneksi.php';
$biodata = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM biodata ORDER BY id DESC LIMIT 1"));
$kontak = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM kontak ORDER BY id DESC LIMIT 1"));
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Contact - Kelly Template</title>
  <link href="kelly-template/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="kelly-template/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="kelly-template/assets/css/main.css" rel="stylesheet">
</head>
<body>
  <?php
include 'koneksi.php';
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM biodata ORDER BY id DESC LIMIT 1"));
?>
<header id="header" class="header d-flex align-items-center light-background sticky-top">
  <div class="container-fluid position-relative d-flex align-items-center justify-content-between">

    <!-- Logo -->
    <a href="index-kelly.php" class="logo d-flex align-items-center me-auto me-xl-0">
      <h1 class="sitename"><?php echo $data['nama_depan'] . ' ' . $data['nama_belakang']; ?></h1>
    </a>

    <!-- Nav Menu -->
    <nav id="navmenu" class="navmenu">
      <ul>
        <li><a href="index-kelly.php">Home</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="contact.php" class="active">Contact</a></li>
      </ul>
      <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    </nav>

    <!-- Social Media Links -->
    <div class="header-social-links">
      <a href="#" class="twitter"><i class="bi bi-twitter-x"></i></a>
      <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
      <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
      <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
    </div>

  </div>
</header>


<section id="contact" class="contact">
  <div class="container">
    <div class="section-title"> 
      <h2>Contact</h2>
      <p><?= htmlspecialchars($kontak['deskripsi_kontak']); ?></p>
    </div>

    <div class="row">
      <div class="col-lg-5 d-flex align-items-stretch">
        <div class="info">
          <div class="address">
            <i class="bi bi-geo-alt"></i>
            <h4>Location:</h4>
            <p><?= htmlspecialchars($kontak['alamat']); ?></p>
          </div>

          <div class="email">
            <i class="bi bi-envelope"></i>
            <h4>Email:</h4>
            <p><?= htmlspecialchars($biodata['email']); ?></p>
          </div>

          <div class="phone">
            <i class="bi bi-phone"></i>
            <h4>Call:</h4>
            <p><?= htmlspecialchars($biodata['hp']); ?></p>
          </div>

          <div class="map mt-3">
             <?= $kontak['peta']; ?>
          </div>
        </div>
      </div>

      <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
        <form action="simpan_pesan.php" method="post" class="php-email-form">
          <div class="row">
            <div class="form-group col-md-6">
              <label>Your Name</label>
              <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="form-group col-md-6">
              <label>Your Email</label>
              <input type="email" name="email" class="form-control" required>
            </div>
          </div>
          <div class="form-group">
            <label>Subject</label>
            <input type="text" name="subjek" class="form-control">
          </div>
          <div class="form-group">
            <label>Message</label>
            <textarea class="form-control" name="isi_pesan" rows="10" required></textarea>
          </div>
          <div class="text-center"><button type="submit">Send Message</button></div>
        </form>
      </div>
    </div>
  </div>
</section>

<script src="kelly-template/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="kelly-template/assets/js/main.js"></script>
</body>
</html>
