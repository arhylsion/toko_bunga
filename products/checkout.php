<?php
    require '../koneksi.php';
    session_start();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $customer_name = $_POST['customer_name'];
        $address = $_POST['address'];
        $additional_notes = isset($_POST['additional_notes']) ? $_POST['additional_notes'] : '';
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
        $query = "INSERT INTO orders (customer_name, total, address, status, additional_notes) VALUES (?, ?, ?, ?, ?)";
        $stmt = $koneksi->prepare($query);
        $stmt->bind_param('sdsss', $customer_name, $total, $address, $status, $additional_notes);
        if ($stmt->execute()) {
            // Clear cart
            unset($_SESSION['cart']);
            echo "Order placed successfully!";
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
</head>
<body>
    <h1>Checkout</h1>
    <form action="" method="post">
        <label for="customer_name">Customer Name</label>
        <input type="text" name="customer_name" id="customer_name" required>
        <label for="address">Address</label>
        <input type="text" name="address" id="address" required>
        <label for="additional_notes">Additional Notes (Optional)</label>
        <textarea name="additional_notes" id="additional_notes" rows="4" cols="50"></textarea>
        <button type="submit">Place Order</button>
        <?php
        // Check if cart is not empty
        if (!empty($cart_items)) {
            echo "<h2>Cart</h2>";
            foreach ($cart_items as $item) {
                $id = $item['id'];
                $quantity = $item['quantity'];
                $query = "SELECT * FROM products WHERE id = $id";
                $result = mysqli_query($koneksi, $query);
                $product = mysqli_fetch_assoc($result);
                echo "<div>";
                echo "<p>{$product['name']}</p>";
                echo "<p>Price: {$product['price']}</p>";
                echo "<p>Quantity: $quantity</p>";
                echo "</div>";
                header("location: checkout.php");
            }
        } else { // Cart is empty
            echo "<p>Your cart is empty</p>";
            header("location: products.php");
        }
    ?>
    </form>
</body>
</html>