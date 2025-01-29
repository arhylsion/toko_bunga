<?php
    require '../koneksi.php';
    session_start();
    if (!isset($_SESSION['login'])) {
        header("location: ../index.php");
        exit;
    }
    $username = $_SESSION['login'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        .dropdown {
            position: relative;
            display: inline-block;
        }
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }
        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }
        .dropdown-content a:hover {background-color: #f1f1f1}
        .dropdown:hover .dropdown-content {
            display: block;
        }
        .dropdown:hover .dropbtn {
            background-color: #3e8e41;
        }
    </style>
</head>
<body>
    <h1>Selamat datang, <?php echo htmlspecialchars($username); ?></h1>
    <a href="logout.php">Logout</a>
    <a href="../products/products.php">Products</a>

    <div class="dropdown">
        <button class="dropbtn">Account Settings</button>
        <div class="dropdown-content">
            <a href="change_address.php">Change Address</a>
            <a href="order_status.php">Order Status</a>
        </div>
    </div>
</body>
</html>