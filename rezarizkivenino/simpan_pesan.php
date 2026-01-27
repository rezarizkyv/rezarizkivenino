<?php
include 'koneksi.php';

$nama   = $_POST['nama'];
$email  = $_POST['email'];
$subjek = $_POST['subjek'];
$pesan  = $_POST['isi_pesan'];

// Query simpan data
$query = "INSERT INTO pesan (nama_pengirim, email_pengirim, judul_pesan, pesan, tgl_pesan) 
          VALUES (?, ?, ?, ?, NOW())";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "ssss", $nama, $email, $subjek, $pesan);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Kirim Pesan</title>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<?php
if (mysqli_stmt_execute($stmt)) {
  // Pesan sukses
  echo "
    <script>
      Swal.fire({
        icon: 'success',
        title: 'Pesan Terkirim!',
        text: 'Terima kasih, pesan Anda sudah kami terima.',
        confirmButtonText: 'OK'
      }).then(() => {
        window.location.href = 'contact.php';
      });
    </script>
  ";
} else {
  // Pesan gagal
  echo "
    <script>
      Swal.fire({
        icon: 'error',
        title: 'Gagal Terkirim!',
        text: 'Pesan tidak berhasil dikirim. Silakan coba lagi.',
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
