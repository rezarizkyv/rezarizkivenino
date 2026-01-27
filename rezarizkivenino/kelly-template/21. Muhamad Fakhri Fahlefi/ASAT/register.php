<?php include 'koneksi.php'; ?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $password, $role);
    $stmt->execute();
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #ffecd2, #fcb69f);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .card {
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
            background-color: #ffffffee;
        }
    </style>
</head>
<body>
    <div class="card" style="width: 100%; max-width: 450px;">
        <h3 class="text-center mb-4 text-danger">Register</h3>
        <form method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" name="username" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">Role:</label>
                <select name="role" class="form-select">
                    <option value="admin">Admin</option>
                    <option value="pembeli">Pembeli</option>
                </select>
            </div>

            <button type="submit" class="btn btn-danger w-100">Register</button>
            <p class="text-center mt-3 text-muted">Sudah punya akun? <a href="login.php">Login</a></p>
        </form>
    </div>
</body>
</html>
