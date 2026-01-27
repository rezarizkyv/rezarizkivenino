<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'pembeli') {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $user = $_SESSION['username'];
    $product_id = $_GET['id'];

    $getUser = mysqli_query($conn, "SELECT id FROM users WHERE username='$user'");
    $userRow = mysqli_fetch_assoc($getUser);
    $user_id = $userRow['id'];

    $stmt = $conn->prepare("INSERT INTO purchases (user_id, product_id, purchase_date) VALUES (?, ?, NOW())");
    $stmt->bind_param("ii", $user_id, $product_id);
    $stmt->execute();

    $success = true;
} else {
    $success = false;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Beli Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5 text-center">
        <div class="alert <?= $success ? 'alert-success' : 'alert-danger' ?> shadow" style="max-width: 600px; margin: auto;">
            <?php if ($success): ?>
                <h4 class="alert-heading">Berhasil!</h4>
                <p>Produk berhasil dibeli. Terima kasih atas pembelian Anda!</p>
                <hr>
                <a href="buyer_dashboard.php" class="btn btn-primary">Kembali ke Dashboard</a>
            <?php else: ?>
                <h4 class="alert-heading">Gagal!</h4>
                <p>Produk tidak ditemukan atau terjadi kesalahan.</p>
                <hr>
                <a href="buyer_dashboard.php" class="btn btn-secondary">Kembali</a>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
