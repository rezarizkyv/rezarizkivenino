<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Ambil produk dari database
$products = mysqli_query($conn, "SELECT * FROM products");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Dashboard Admin</h2>
            <a href="logout.php" class="btn btn-outline-danger">Logout</a>
        </div>

        <div class="mb-4">
            <a href="add_product.php" class="btn btn-success">+ Tambah Produk</a>
        </div>

        <h5>Daftar Produk</h5>
        <div class="table-responsive">
            <table class="table table-bordered table-hover mt-3">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Deskripsi</th>
                        <th>Harga</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; while($row = mysqli_fetch_assoc($products)): ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= htmlspecialchars($row['name']) ?></td>
                            <td><?= htmlspecialchars($row['description']) ?></td>
                            <td>Rp<?= number_format($row['price'], 0, ',', '.') ?></td>
                            <td>
                                <?php if ($row['image']): ?>
                                    <img src="uploads/<?= $row['image'] ?>" width="80">
                                <?php else: ?>
                                    Tidak ada
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="delete_product.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                    <?php if (mysqli_num_rows($products) === 0): ?>
                        <tr><td colspan="6" class="text-center">Belum ada produk</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
