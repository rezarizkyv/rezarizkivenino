<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Hapus gambar jika ada
    $res = mysqli_query($conn, "SELECT image FROM products WHERE id=$id");
    $row = mysqli_fetch_assoc($res);
    if ($row && $row['image']) {
        $path = 'uploads/' . $row['image'];
        if (file_exists($path)) unlink($path);
    }

    mysqli_query($conn, "DELETE FROM products WHERE id=$id");
}

header("Location: admin_dashboard.php");
exit();
