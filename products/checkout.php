<?php
    require '../koneksi.php';
    session_start();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $customer_name = $_POST['customer_name'];
        $address = $_POST['address'];
        $total = 0;
        $status = 'Pending';

        // Calculate total
        foreach ($_SESSION['cart'] as $item) {
            $id = $item['id'];
            $quantity = $item['quantity'];
            $query = "SELECT price FROM products WHERE id = $id";
            $result = mysqli_query($koneksi, $query);
            $product = mysqli_fetch_assoc($result);
            $total += $product['price'] * $quantity;
        }

        // Insert order
        $query = "INSERT INTO orders (customer_name, total, address, status) VALUES (?, ?, ?, ?)";
        $stmt = $koneksi->prepare($query);
        $stmt->bind_param('sdss', $customer_name, $total, $address, $status);
        if ($stmt->execute()) {
            // Clear cart
            unset($_SESSION['cart']);
            // Redirect to order status page
            header("location: checkout.php");
            exit;
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
        exit;
    }

    $cart_items = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Checkout</h1>
        <form action="" method="post">
            <div class="form-group">
                <label for="customer_name">Customer Name</label>
                <input type="text" name="customer_name" id="customer_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" name="address" id="address" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Place Order</button>
        </form>
        <h2 class="mt-5">Cart</h2>
        <?php if (!empty($cart_items)): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cart_items as $item): ?>
                        <?php
                            $id = $item['id'];
                            $quantity = $item['quantity'];
                            $query = "SELECT * FROM products WHERE id = $id";
                            $result = mysqli_query($koneksi, $query);
                            $product = mysqli_fetch_assoc($result);
                        ?>
                        <tr>
                            <td><?php echo $product['name']; ?></td>
                            <td><?php echo $product['price']; ?></td>
                            <td><?php echo $quantity; ?></td>
                            <td><?php echo $product['price'] * $quantity; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Your cart is empty</p>
        <?php endif; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>