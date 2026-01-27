<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'pembeli') {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$getUser = mysqli_query($conn, "SELECT id FROM users WHERE username='$username'");
$userRow = mysqli_fetch_assoc($getUser);
$user_id = $userRow['id'];

$purchases = mysqli_query($conn, "
    SELECT p.name, p.description, p.price, pr.purchase_date 
    FROM purchases pr 
    JOIN products p ON pr.product_id = p.id 
    WHERE pr.user_id = $user_id 
    ORDER BY pr.purchase_date DESC
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Pembelian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Riwayat Pembelian</h2>
            <a href="buyer_dashboard.php" class="btn btn-secondary">Kembali</a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Deskripsi</th>
                        <th>Harga</th>
                        <th>Tanggal Pembelian</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; while($row = mysqli_fetch_assoc($purchases)): ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= htmlspecialchars($row['name']) ?></td>
                            <td><?= htmlspecialchars($row['description']) ?></td>
                            <td>Rp<?= number_format($row['price'], 0, ',', '.') ?></td>
                            <td><?= date("d M Y, H:i", strtotime($row['purchase_date'])) ?></td>
                        </tr>
                    <?php endwhile; ?>
                    <?php if (mysqli_num_rows($purchases) === 0): ?>
                        <tr>
                            <td colspan="5" class="text-center text-muted">Belum ada pembelian.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
