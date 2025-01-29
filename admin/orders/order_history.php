<?php
    require '../../koneksi.php';
    session_start();

    // Pastikan hanya admin yang dapat mengakses halaman ini
    if (!isset($_SESSION['login'])) {
        header("location: ../../index.php");
        exit;
    }

    // Ambil daftar pesanan dari database
    $query = "SELECT * FROM orders";
    $result = mysqli_query($koneksi, $query);

    // Ubah status pesanan jika ada permintaan POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $order_id = $_POST['order_id'];
        $status = $_POST['status'];

        $update_query = "UPDATE orders SET status = ? WHERE order_id = ?";
        $stmt = $koneksi->prepare($update_query);
        $stmt->bind_param('si', $status, $order_id);
        if ($stmt->execute()) {
            echo "Order status updated successfully";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();

        // Refresh halaman untuk melihat perubahan
        header("location: order_history.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History</title>
</head>
<body>
    <h1>Order History</h1>
    <table border="1">
        <tr>
            <th>Order ID</th>
            <th>Customer Name</th>
            <th>Total</th>
            <th>Address</th>
            <th>Status</th>
            <th>Additional Notes</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?php echo $row['order_id']; ?></td>
            <td><?php echo $row['customer_name']; ?></td>
            <td><?php echo $row['total']; ?></td>
            <td><?php echo $row['address']; ?></td>
            <td><?php echo $row['status']; ?></td>
            <td><?php echo $row['additional_notes']; ?></td>
            <td>
                <form action="" method="post">
                    <input type="hidden" name="order_id" value="<?php echo $row['order_id']; ?>">
                    <select name="status">
                        <option value="Pending" <?php if ($row['status'] == 'Pending') echo 'selected'; ?>>Pending</option>
                        <option value="Processing" <?php if ($row['status'] == 'Processing') echo 'selected'; ?>>Processing</option>
                        <option value="Completed" <?php if ($row['status'] == 'Completed') echo 'selected'; ?>>Completed</option>
                        <option value="Cancelled" <?php if ($row['status'] == 'Cancelled') echo 'selected'; ?>>Cancelled</option>
                    </select>
                    <button type="submit">Update Status</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>