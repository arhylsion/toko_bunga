<?php
    require '../koneksi.php';
    session_start();
    if (!isset($_SESSION['login'])) {
        header("location: ../index.php");
        exit;
    }

    $username = $_SESSION['login'];
    $query = "SELECT * FROM orders WHERE customer_name = ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Status</title>
</head>
<body>
    <h1>Order Status</h1>
    <table border="1">
        <tr>
            <th>Order ID</th>
            <th>Total</th>
            <th>Address</th>
            <th>Status</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['total']; ?></td>
            <td><?php echo $row['address']; ?></td>
            <td><?php echo $row['status']; ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
    <a href="index.php">Back to Dashboard</a>
</body>
</html>