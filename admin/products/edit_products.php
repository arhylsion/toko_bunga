<?php
    require '../../koneksi.php';
    session_start();
    if (!isset($_SESSION['login'])) {
        header("location: ../index.php");
        exit;
    }

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

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $stock = $_POST['stock'];
        $order_type = $_POST['order_type'];
        $color = $_POST['color'];
        $size = $_POST['size'];

        // Validate enum values
        $valid_order_types = ['Bunga Asli', 'Bunga Kawat', 'Bunga Plastik']; // order_type enum values
        $valid_colors = ['Biru Pastel', 'Pink Pastel', 'Ungu Pastel', 'Navy', 'Hitam', 'Maroon', 'Putih']; // color enum values
        $valid_sizes = ['Small', 'Medium', 'Big']; // size enum values

        if (in_array($order_type, $valid_order_types) && in_array($color, $valid_colors) && in_array($size, $valid_sizes)) {
            $query = "UPDATE products SET name = ?, price = ?, stock = ?, order_type = ?, color = ?, size = ? WHERE id = ?";
            $stmt = $koneksi->prepare($query);
            $stmt->bind_param('sissssi', $name, $price, $stock, $order_type, $color, $size, $id);
            if ($stmt->execute()) {
                echo "Product updated successfully";
                header("location: main_products.php");
                exit;
            } else {
                echo "Error: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Invalid enum value provided.";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
</head>
<body>
    <form action="" method="post">
        <h1>Edit Product</h1>
        <a href="main_products.php">Back To List</a>
        <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" value="<?php echo $product['name']; ?>" required>
        <label for="price">Price</label>
        <input type="number" step="0.01" name="price" id="price" value="<?php echo $product['price']; ?>" required>
        <label for="stock">Stock</label>
        <input type="number" name="stock" id="stock" value="<?php echo $product['stock']; ?>" required>
        <label for="order_type">Order Type</label>
        <select name="order_type" id="order_type" required>
            <option value="Bunga Asli" <?php if ($product['order_type'] == 'Bunga Asli') echo 'selected'; ?>>Bunga Asli</option>
            <option value="Bunga Kawat" <?php if ($product['order_type'] == 'Bunga Kawat') echo 'selected'; ?>>Bunga Kawat</option>
            <option value="Bunga Plastik" <?php if ($product['order_type'] == 'Bunga Plastik') echo 'selected'; ?>>Bunga Plastik</option>
        </select>
        <label for="color">Color</label>
        <select name="color" id="color" required>
            <option value="Biru Pastel" <?php if ($product['color'] == 'Biru Pastel') echo 'selected'; ?>>Biru Pastel</option>
            <option value="Pink Pastel" <?php if ($product['color'] == 'Pink Pastel') echo 'selected'; ?>>Pink Pastel</option>
            <option value="Ungu Pastel" <?php if ($product['color'] == 'Ungu Pastel') echo 'selected'; ?>>Ungu Pastel</option>
            <option value="Navy" <?php if ($product['color'] == 'Navy') echo 'selected'; ?>>Navy</option>
            <option value="Hitam" <?php if ($product['color'] == 'Hitam') echo 'selected'; ?>>Hitam</option>
            <option value="Maroon" <?php if ($product['color'] == 'Maroon') echo 'selected'; ?>>Maroon</option>
            <option value="Putih" <?php if ($product['color'] == 'Putih') echo 'selected'; ?>>Putih</option>
        </select>
        <label for="size">Size</label>
        <select name="size" id="size" required>
            <option value="Small" <?php if ($product['size'] == 'Small') echo 'selected'; ?>>Small</option>
            <option value="Medium" <?php if ($product['size'] == 'Medium') echo 'selected'; ?>>Medium</option>
            <option value="Big" <?php if ($product['size'] == 'Big') echo 'selected'; ?>>Big</option>
        </select>
        <button type="submit">Update Product</button>
    </form>
</body>
</html>
