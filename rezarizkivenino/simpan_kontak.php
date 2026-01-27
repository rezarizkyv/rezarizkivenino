<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi_kontak']);
    $alamat    = mysqli_real_escape_string($conn, $_POST['alamat']);
    $peta      = mysqli_real_escape_string($conn, $_POST['peta']);

    $query = "INSERT INTO kontak (deskripsi_kontak, alamat, peta) VALUES ('$deskripsi', '$alamat', '$peta')";
    $status = mysqli_query($conn, $query);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Sweet Alert Feedback</title>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<script>
<?php if (isset($status) && $status): ?>
    Swal.fire({
        icon: 'success',
        title: 'Sukses!',
        text: 'Data kontak berhasil disimpan.',
    }).then(() => {
        window.location.href = 'form_kontak.php';
    });
<?php elseif (isset($status)): ?>
    Swal.fire({
        icon: 'error',
        title: 'Gagal!',
        text: 'Data gagal disimpan.',
    }).then(() => {
        window.location.href = 'form_kontak.php';
    });
<?php endif; ?>
</script>
</body>
</html>
