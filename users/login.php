<?php 
    require '../koneksi.php';
    require 'session.php';
    if (isset($_POST['login'])) {
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['username']);
        $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($koneksi, $query);
        $row = mysqli_num_rows($result);
        if ($row > 0) {
            $_SESSION['login'] = $username && $password;
            header("location: index.php");
        } else {
            echo "Login gagal";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" required>
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>
        <button type="submit" name="login">Login</button>
        <a href="register.php">Register</a> Uncaught mysqli_sql_exception: Unknown column 'cobain' in 'field list' in C:\laragon\www\toko_bunga\users\register.php:11 Stack trace: #0 C:\laragon\www\toko_bunga\users\register.php(11): mysqli_query(Object(mysqli), 'INSERT INTO use...') #1 {main} thrown in C:\laragon\www\toko_bunga\users\register.php on line 11
    </form>
    
    
</body>
</html>