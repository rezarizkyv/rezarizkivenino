<?php
include 'koneksi.php';

// Ambil data terakhir dari tabel biodata
$result = mysqli_query($conn, "SELECT * FROM biodata ORDER BY id DESC LIMIT 1");
$data = mysqli_fetch_assoc($result);

if (!$data) {
  $data = [
    'nama_depan' => '',
    'nama_belakang' => '',
    'tentang' => '',
    'profesi' => '',
    'deskripsi_profesi' => '',
    'tgl_lahir' => '2000-01-01',
    'website' => '',
    'gelar' => '',
    'hp' => '',
    'email' => '',
    'kota' => '',
    'freelance' => '',
    'keterangan_about' => '',
    'keterangan_skill' => '',
    'skill' => '[{"skill":"HTML","value":"90"},{"skill":"PHP","value":"80"},{"skill":"CSS","value":"75"}]',
    'url_foto' => 'default.jpg'
  ];
}

$freelance = isset($data['freelance']) && trim($data['freelance']) !== '' ? ($data['freelance'] == 1 ? 'Available' : 'Not Available') : '-';
// Hitung usia dari tanggal lahir
$tgl_lahir = new DateTime($data['tgl_lahir']);
$today = new DateTime();
$usia = $today->diff($tgl_lahir)->y;

// Ambil skill dari JSON
$skills = json_decode($data['skill'], true);

// Cek foto
$nama_foto = trim($data['url_foto']);
$foto_path = "uploads/" . ($nama_foto !== '' ? $nama_foto : "default.jpg");
if (!file_exists($foto_path) || is_dir($foto_path)) {
  $foto_path = "uploads/default.jpg";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>About - Kelly Template</title>
  <link href="kelly-template/assets/css/main.css" rel="stylesheet">
  <link href="kelly-template/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="kelly-template/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php
include 'koneksi.php';
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM biodata ORDER BY id DESC LIMIT 1"));
?>
<header id="header" class="header d-flex align-items-center light-background sticky-top">
  <div class="container-fluid position-relative d-flex align-items-center justify-content-between">

    <!-- Logo -->
    <a href="index-kelly.php" class="logo d-flex align-items-center me-auto me-xl-0 text-decoration-none">
  <h1 class="sitename text-dark m-0"><?php echo $data['nama_depan'] . ' ' . $data['nama_belakang']; ?></h1>
</a>

    <!-- Nav Menu -->
    <nav id="navmenu" class="navmenu">
      <ul>
        <li><a href="index-kelly.php">Home</a></li>
        <li><a href="about.php" class="active">About</a></li>
        <li><a href="contact.php">Contact</a></li>
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

<section id="about" class="about">
  <div class="container">
    <div class="section-title">
      <h2>About</h2>
      <p><?= htmlspecialchars($data['tentang']); ?></p>
    </div>

    <div class="row">
      <div class="col-lg-4">
        <img src="<?= htmlspecialchars($foto_path); ?>" class="img-fluid" alt="Foto Profil">
      </div>
      <div class="col-lg-8 pt-4 pt-lg-0 content">
        <h3><?= htmlspecialchars($data['profesi']); ?></h3>
        <p class="fst-italic"><?= htmlspecialchars($data['deskripsi_profesi']); ?></p>
        <div class="row">
          <div class="col-lg-6">
            <ul>
              <li><i class="bi bi-chevron-right"></i> <strong>Birthday:</strong> <span><?= htmlspecialchars($data['tgl_lahir']); ?></span></li>
              <li><i class="bi bi-chevron-right"></i> <strong>Website:</strong> <span><?= htmlspecialchars($data['website']); ?></span></li>
              <li><i class="bi bi-chevron-right"></i> <strong>Phone:</strong> <span><?= htmlspecialchars($data['hp']); ?></span></li>
              <li><i class="bi bi-chevron-right"></i> <strong>City:</strong> <span><?= htmlspecialchars($data['kota']); ?></span></li>
            </ul>
          </div>
          <div class="col-lg-6">
            <ul>
              <li><i class="bi bi-chevron-right"></i> <strong>Age:</strong> <span><?= $usia; ?></span></li>
              <li><i class="bi bi-chevron-right"></i> <strong>Degree:</strong> <span><?= htmlspecialchars($data['gelar']); ?></span></li>
              <li><i class="bi bi-chevron-right"></i> <strong>Email:</strong> <span><?= htmlspecialchars($data['email']); ?></span></li>
              <li><i class="bi bi-chevron-right"></i> <strong>Freelance:</strong> <span><?php echo $freelance; ?> </span></li>
            </ul>
          </div>
        </div>
        <p><?= htmlspecialchars($data['keterangan_about']); ?></p>
      </div>
    </div>
  </div>
</section>

<section id="skills" class="skills section-bg">
  <div class="container">
    <div class="section-title">
      <h2>Skills</h2>
      <p><?= htmlspecialchars($data['keterangan_skill']); ?></p>
    </div>

    <div class="row skills-content">
      <div class="col-lg-12">
        <?php if (is_array($skills)): ?>
          <?php foreach ($skills as $skill): ?>
            <div class="progress">
              <span class="skill"><?= htmlspecialchars($skill['skill']); ?> <i class="val"><?= intval($skill['value']); ?>%</i></span>
              <div class="progress-bar-wrap">
                <div class="progress-bar" role="progressbar" 
                  style="width: <?= intval($skill['value']); ?>%" 
                  aria-valuenow="<?= intval($skill['value']); ?>" 
                  aria-valuemin="0" aria-valuemax="100">
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <p>Tidak ada data skill yang valid.</p>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>

</body>
</html>
