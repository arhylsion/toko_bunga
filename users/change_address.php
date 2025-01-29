<?php
    require '../koneksi.php';
    session_start();
    if (!isset($_SESSION['login'])) {
        header("location: ../index.php");
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $new_address = $_POST['address'];
        $username = $_SESSION['login'];

        $query = "UPDATE users SET address = ? WHERE username = ?";
        $stmt = $koneksi->prepare($query);
        $stmt->bind_param('ss', $new_address, $username);
        if ($stmt->execute()) {
            echo "Address updated successfully";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Address</title>
</head>
<body>
    <h1>Change Address</h1>
    <form action="" method="post">
        <label for="address">New Address</label>
        <input type="text" name="address" id="address" required>
        <button type="submit">Update Address</button>
    </form>
    <a href="index.php">Back to Dashboard</a>
</body>
</html>