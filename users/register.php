<?php 
    require '../koneksi.php';
    session_start();
    if (isset($_POST['register'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $nama_lengkap = $_POST['nama_lengkap'];
        $address = $_POST['address'];

        // Ensure the column names match your database table
        $query = "INSERT INTO users (username, password, nama_lengkap, address) VALUES ('$username', '$password', '$nama_lengkap', '$address')";
        $result = mysqli_query($koneksi, $query);
        if ($result) {
            echo "Register berhasil";
            header("location: login.php");
        } else {
            echo "Register gagal";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .register-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        .register-container h3 {
            margin-bottom: 20px;
        }
        .register-container .form-group {
            margin-bottom: 15px;
        }
        .register-container .btn {
            width: 100%;
        }
        .register-container .login-link {
            display: block;
            margin-top: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h3 class="text-center">Register</h3>
        <form action="" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="nama_lengkap">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="address">Alamat</label>
                <input type="text" name="address" id="address" class="form-control" required>
            </div>
            <button type="submit" name="register" class="btn btn-primary">Register</button>
            <a href="login.php" class="login-link">Already have an account? Login</a>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
