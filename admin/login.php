<?php
    require '../koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
</head>
<body>
    <form action="" method="post">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" required>
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>
        <button type="submit" name="login">Login</button>
    </form>
    

    <?php // login.php untuk admin 
        if (isset($_POST['login'])) {
            $username = htmlspecialchars($_POST['username']);
            $password = htmlspecialchars($_POST['password']);

            $query = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
            $result = mysqli_query($koneksi, $query);
            $row = mysqli_num_rows($result);

            if ($row > 0) {
                session_start();
                $_SESSION['login'] = true;
                header("location: index.php");
            } else {
                echo "Login gagal";
            }
        }

    ?>
    
</body>
</html>