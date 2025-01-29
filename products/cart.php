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
</head>
<body>
    <h1>Shopping Cart</h1>
    <a href="products.php">Back to Products</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Order Type</th>
            <th>Color</th>
            <th>Size</th>
            <th>Quantity</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($cart_items as $index => $item): ?>
        <tr>
            <td><?php echo $item['id']; ?></td>
            <td><?php echo $item['order_type']; ?></td>
            <td><?php echo $item['color']; ?></td>
            <td><?php echo $item['size']; ?></td>
            <td><?php echo $item['quantity']; ?></td>
            <td>
                <a href="delete_product_cart.php?action=decrease&index=<?php echo $index; ?>">-</a>
                <a href="delete_product_cart.php?action=remove&index=<?php echo $index; ?>">Remove</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <form action="checkout.php" method="post">
        <label for="additional_notes">Additional Notes (Optional)</label>
        <textarea name="additional_notes" id="additional_notes" rows="4" cols="50"></textarea>
        <button type="submit">Proceed to Checkout</button>
    </form>
</body>
</html>