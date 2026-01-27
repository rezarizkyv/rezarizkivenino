<?php
$host = 'localhost';
$user = 'root';
$pass = 'root123';
$db   = 'ujian_sija'; 

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
