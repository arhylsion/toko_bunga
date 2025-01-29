<?php 
    require '../koneksi.php';
    session_start();
    if (isset($_POST['register'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $nama_lengkap = $_POST['nama_lengkap'];
        $address = $_POST['address'];

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
    <title>register</title>
</head>
<body>
    <div class="form-container">
        <form action="" method="post">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" required>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
            <label for="nama_lengkap">Nama Lengkap</label>
            <input type="text" name="nama_lengkap" id="nama_lengkap" required>
            <label for="address">Alamat</label>
            <input type="text" name="address" id="address" required>
            <button type="submit" name="register">Register</button>
    </div>

    <?php 

    ?>   
    
</body>
</html>
    