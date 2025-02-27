<?php
    require '../../koneksi.php';
    session_start();
    if (!isset($_SESSION['login'])) {
        header("location: ../login.php");
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
            $query = "INSERT INTO products (name, price, stock, order_type, color, size) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $koneksi->prepare($query);  
            $stmt->bind_param('sissss', $name, $price, $stock, $order_type, $color, $size);
            if ($stmt->execute()) {
                echo "Product added successfully";
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
    <title>Add Product</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="../index.php">Toko Bunga</a>
    </nav>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Add Product</h1>
        <a href="main_products.php" class="btn btn-secondary mb-4">Back to Product List</a>
        <form action="" method="post">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" step="0.01" name="price" id="price" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="stock">Stock</label>
                <input type="number" name="stock" id="stock" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="order_type">Order Type</label>
                <select name="order_type" id="order_type" class="form-control" required>
                    <option value="Bunga Asli">Bunga Asli</option>
                    <option value="Bunga Kawat">Bunga Kawat</option>
                    <option value="Bunga Plastik">Bunga Plastik</option>
                </select>
            </div>
            <div class="form-group">
                <label for="color">Color</label>
                <select name="color" id="color" class="form-control" required>
                    <option value="Biru Pastel">Biru Pastel</option>
                    <option value="Pink Pastel">Pink Pastel</option>
                    <option value="Ungu Pastel">Ungu Pastel</option>
                    <option value="Navy">Navy</option>
                    <option value="Hitam">Hitam</option>
                    <option value="Maroon">Maroon</option>
                    <option value="Putih">Putih</option>
                </select>
            </div>
            <div class="form-group">
                <label for="size">Size</label>
                <select name="size" id="size" class="form-control" required>
                    <option value="Small">Small</option>
                    <option value="Medium">Medium</option>
                    <option value="Big">Big</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Add Product</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>