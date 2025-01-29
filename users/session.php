<?php
    session_start();
    if (isset($_POST['login'])) {
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);
        $hashed_password = hash('sha256', $password);
        
        $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($koneksi, $query);
        $row = mysqli_fetch_assoc($result);

        if ($row) {
            $_SESSION['login'] = true;
            header("location: index.php");
        } else {
            echo "Username atau password salah";
        }
    }