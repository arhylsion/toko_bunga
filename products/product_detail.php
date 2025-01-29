<?php
    require '../koneksi.php';
    session_start();

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "SELECT * FROM products WHERE id = ?";
        $stmt = $koneksi->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $product = $result->fetch_assoc();
        $stmt->close();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Detail</title>
</head>
<body>
    <h1><?php echo $product['name']; ?></h1>
    <p>Price: <?php echo $product['price']; ?></p>
    <p>Stock: <?php echo $product['stock']; ?></p>
    <form action="add_to_cart.php" method="post">
        <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
        <label for="order_type">Order Type</label>
        <select name="order_type" id="order_type" required>
            <option value="Bunga Asli">Bunga Asli</option>
            <option value="Bunga Kawat">Bunga Kawat</option>
            <option value="Bunga Plastik">Bunga Plastik</option>
        </select>
        <label for="color">Color</label>
        <select name="color" id="color" required>
            <option value="Biru Pastel">Biru Pastel</option>
            <option value="Pink Pastel">Pink Pastel</option>
            <option value="Ungu Pastel">Ungu Pastel</option>
            <option value="Navy">Navy</option>
            <option value="Hitam">Hitam</option>
            <option value="Maroon">Maroon</option>
            <option value="Putih">Putih</option>
        </select>
        <label for="size">Size</label>
        <select name="size" id="size" required>
            <option value="Small">Small</option>
            <option value="Medium">Medium</option>
            <option value="Big">Big</option>
        </select>
        <label for="quantity">Quantity</label>
        <input type="number" name="quantity" id="quantity" required>
        <button type="submit">Add to Cart</button>
    </form>
</body>
</html>