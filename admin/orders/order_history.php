<?php
    require '../../koneksi.php';
    session_start();

    // Ensure only admin can access this page
    if (!isset($_SESSION['login'])) {
        header("location: ../../index.php");
        exit;
    }

    // Fetch orders from the database
    $query = "SELECT * FROM orders";
    $result = mysqli_query($koneksi, $query);

    // Update order status if a POST request is made
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_status'])) {
        $order_id = $_POST['order_id'];
        $status = $_POST['status'];

        $update_query = "UPDATE orders SET status = ? WHERE id = ?";
        $stmt = $koneksi->prepare($update_query);
        $stmt->bind_param('si', $status, $order_id);
        if ($stmt->execute()) {
            echo "Order status updated successfully";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();

        // Refresh the page to see the changes
        header("location: order_history.php");
        exit;
    }

    // Delete order if a POST request is made
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_order'])) {
        $order_id = $_POST['order_id'];

        $delete_query = "DELETE FROM orders WHERE id = ?";
        $stmt = $koneksi->prepare($delete_query);
        $stmt->bind_param('i', $order_id);
        if ($stmt->execute()) {
            echo "Order deleted successfully";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();

        // Refresh the page to see the changes
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
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Order History</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Total</th>
                    <th>Address</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['customer_name']; ?></td>
                    <td><?php echo $row['total']; ?></td>
                    <td><?php echo $row['address']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td>
                        <form action="" method="post" style="display:inline-block;">
                            <input type="hidden" name="order_id" value="<?php echo $row['id']; ?>">
                            <select name="status" class="form-control mb-2">
                                <option value="Pending" <?php if ($row['status'] == 'Pending') echo 'selected'; ?>>Pending</option>
                                <option value="Processing" <?php if ($row['status'] == 'Processing') echo 'selected'; ?>>Processing</option>
                                <option value="Completed" <?php if ($row['status'] == 'Completed') echo 'selected'; ?>>Completed</option>
                                <option value="Cancelled" <?php if ($row['status'] == 'Cancelled') echo 'selected'; ?>>Cancelled</option>
                            </select>
                            <button type="submit" name="update_status" class="btn btn-primary btn-sm">Update Status</button>
                        </form>
                        <form action="" method="post" style="display:inline-block;">
                            <input type="hidden" name="order_id" value="<?php echo $row['id']; ?>">
                            <button type="submit" name="delete_order" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this order?');">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>