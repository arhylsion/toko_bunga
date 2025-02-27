<?php 
    require '../koneksi.php';
    session_start();
    if (isset($_POST['login'])) {
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);
        $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($koneksi, $query);
        $row = mysqli_fetch_assoc($result);
        if ($row) {
            $_SESSION['login'] = $username;
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
    <title>Login</title>
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
        .register-container .register-link {
            display: block;
            margin-top: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h3 class="text-center">Login</h3>
        <form action="" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <button type="submit" name="login" class="btn btn-primary">Login</button>
            <a href="register.php" class="register-link">Don't have an account? Create one!</a>
        </form>
    </div>

    

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>