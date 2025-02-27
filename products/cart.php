<?php
    require '../koneksi.php';
    session_start();

    $cart_items = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Shopping Cart</h1>
        <a href="products.php" class="btn btn-secondary mb-4">Back to Products</a>
        <?php if (!empty($cart_items)): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Order Type</th>
                        <th>Color</th>
                        <th>Size</th>
                        <th>Quantity</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cart_items as $index => $item): ?>
                    <tr>
                        <td><?php echo $item['id']; ?></td>
                        <td><?php echo $item['order_type']; ?></td>
                        <td><?php echo $item['color']; ?></td>
                        <td><?php echo $item['size']; ?></td>
                        <td><?php echo $item['quantity']; ?></td>
                        <td>
                            <a href="delete_product_cart.php?action=decrease&index=<?php echo $index; ?>" class="btn btn-warning btn-sm">-</a>
                            <a href="delete_product_cart.php?action=remove&index=<?php echo $index; ?>" class="btn btn-danger btn-sm">Remove</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <form action="checkout.php" method="post">
                <button type="submit" class="btn btn-primary">Proceed to Checkout</button>
            </form>
        <?php else: ?>
            <p>Your cart is empty</p>
        <?php endif; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>