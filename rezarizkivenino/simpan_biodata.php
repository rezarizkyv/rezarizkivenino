<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include 'koneksi.php';

$nama_depan         = mysqli_real_escape_string($conn, $_POST['nama_depan']);
$nama_belakang      = mysqli_real_escape_string($conn, $_POST['nama_belakang']);
$tentang            = mysqli_real_escape_string($conn, $_POST['tentang']);
$profesi            = mysqli_real_escape_string($conn, $_POST['profesi']);
$deskripsi_profesi  = mysqli_real_escape_string($conn, $_POST['deskripsi_profesi']);
$tgl_lahir          = mysqli_real_escape_string($conn, $_POST['tgl_lahir']);
$website            = mysqli_real_escape_string($conn, $_POST['website']);
$gelar              = mysqli_real_escape_string($conn, $_POST['gelar']);
$hp                 = mysqli_real_escape_string($conn, $_POST['hp']);
$email              = mysqli_real_escape_string($conn, $_POST['email']);
$kota               = mysqli_real_escape_string($conn, $_POST['kota']);
$freelance          = mysqli_real_escape_string($conn, $_POST['freelance']);
$keterangan_about   = mysqli_real_escape_string($conn, $_POST['keterangan_about']);
$keterangan_skill   = mysqli_real_escape_string($conn, $_POST['keterangan_skill']);

$skill_input = $_POST['skill'];
$skill_array = explode(',', $skill_input);
$skill_json = [];

for ($i = 0; $i < count($skill_array); $i += 2) {
    if (isset($skill_array[$i + 1])) {
        $skill_json[] = [
            'skill' => trim($skill_array[$i]),
            'value' => trim($skill_array[$i + 1])
        ];
    }
}
$skill = mysqli_real_escape_string($conn, json_encode($skill_json));

// Upload foto biasa
$url_foto = 'default.jpg';
if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
    $foto_name = time() . '_' . basename($_FILES['foto']['name']);
    $target_path_foto = 'uploads/' . $foto_name;

    if (!is_dir('uploads')) {
        mkdir('uploads', 0777, true);
    }

    if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_path_foto)) {
        $url_foto = $foto_name;
    }
}

// Upload hero image
$url_hero = 'default.jpg';
if (isset($_FILES['url_hero']) && $_FILES['url_hero']['error'] === 0) {
    $hero_name = time() . '_' . basename($_FILES['url_hero']['name']);
    $target_path_hero = 'uploads/hero/' . $hero_name;

    if (!is_dir('uploads/hero')) {
        mkdir('uploads/hero', 0777, true);
    }

    if (move_uploaded_file($_FILES['url_hero']['tmp_name'], $target_path_hero)) {
        $url_hero = $hero_name;
    }
}

// Query simpan
$query = "INSERT INTO biodata 
(nama_depan, nama_belakang, tentang, profesi, deskripsi_profesi, tgl_lahir, website, gelar, hp, email, kota, freelance, keterangan_about, keterangan_skill, skill, url_hero, url_foto)
VALUES 
('$nama_depan', '$nama_belakang', '$tentang', '$profesi', '$deskripsi_profesi', '$tgl_lahir', '$website', '$gelar', '$hp', '$email', '$kota', '$freelance', '$keterangan_about', '$keterangan_skill', '$skill', '$url_hero', '$url_foto')";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Notifikasi</title>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<?php
if (mysqli_query($conn, $query)) {
    echo "
    <script>
    Swal.fire({
      icon: 'success',
      title: 'Berhasil!',
      text: 'Data biodata berhasil disimpan.',
      confirmButtonText: 'OK'
    }).then(() => {
      window.location.href = 'index-kelly.php';
    });
    </script>
    ";
} else {
    $error = mysqli_real_escape_string($conn, mysqli_error($conn));
    echo "
    <script>
    Swal.fire({
      icon: 'error',
      title: 'Gagal!',
      html: 'Terjadi kesalahan saat menyimpan data:<br><code>$error</code>',
      confirmButtonText: 'Coba Lagi'
    }).then(() => {
      window.history.back();
    });
    </script>
    ";
}
?>
</body>
</html>
