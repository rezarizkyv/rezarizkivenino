<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'pembeli') {
    header("Location: login.php");
    exit();
}

$products = mysqli_query($conn, "SELECT * FROM products");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Pembeli</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-4">
       <div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Dashboard Pembeli</h2>
    <div>
        <a href="purchase_history.php" class="btn btn-outline-primary me-2">Riwayat Pembelian</a>
        <a href="logout.php" class="btn btn-outline-danger">Logout</a>
    </div>
</div>


        <div class="row">
            <?php while($row = mysqli_fetch_assoc($products)): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow">
                        <?php if ($row['image']): ?>
                            <img src="uploads/<?= $row['image'] ?>" class="card-img-top" style="max-height: 180px; object-fit: cover;">
                        <?php else: ?>
                            <div class="card-img-top bg-secondary text-white text-center p-5">Tidak Ada Gambar</div>
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($row['name']) ?></h5>
                            <p class="card-text"><?= htmlspecialchars($row['description']) ?></p>
                            <p class="text-success fw-bold">Rp<?= number_format($row['price'], 0, ',', '.') ?></p>
                        </div>
                        <div class="card-footer text-center bg-white">
                            <a href="buy_product.php?id=<?= $row['id'] ?>" class="btn btn-primary w-100">Beli</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>

            <?php if (mysqli_num_rows($products) === 0): ?>
                <div class="col-12 text-center">
                    <p class="text-muted">Belum ada produk yang tersedia.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
