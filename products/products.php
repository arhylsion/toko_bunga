<?php
    require '../koneksi.php';
    session_start();

    // Fetch filter options
    $order_types = ['Bunga Asli', 'Bunga Kawat', 'Bunga Plastik'];
    $colors = ['Biru Pastel', 'Pink Pastel', 'Ungu Pastel', 'Navy', 'Hitam', 'Maroon', 'Putih'];
    $sizes = ['Small', 'Medium', 'Big'];

    // Initialize filters
    $selected_order_type = isset($_GET['order_type']) ? $_GET['order_type'] : '';
    $selected_color = isset($_GET['color']) ? $_GET['color'] : '';
    $selected_size = isset($_GET['size']) ? $_GET['size'] : '';

    // Build query with filters
    $query = "SELECT * FROM products WHERE 1=1";
    if ($selected_order_type) {
        $query .= " AND order_type = '$selected_order_type'";
    }
    if ($selected_color) {
        $query .= " AND color = '$selected_color'";
    }
    if ($selected_size) {
        $query .= " AND size = '$selected_size'";
    }
    $result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Dashboard</title>
</head>
<body>
    <h1>Product Dashboard</h1>
    <form method="get" action="">
        <label for="order_type">Order Type</label>
        <select name="order_type" id="order_type">
            <option value="">All</option>
            <?php foreach ($order_types as $type): ?>
                <option value="<?php echo $type; ?>" <?php if ($selected_order_type == $type) echo 'selected'; ?>><?php echo $type; ?></option>
            <?php endforeach; ?>
        </select>
        <label for="color">Color</label>
        <select name="color" id="color">
            <option value="">All</option>
            <?php foreach ($colors as $color): ?>
                <option value="<?php echo $color; ?>" <?php if ($selected_color == $color) echo 'selected'; ?>><?php echo $color; ?></option>
            <?php endforeach; ?>
        </select>
        <label for="size">Size</label>
        <select name="size" id="size">
            <option value="">All</option>
            <?php foreach ($sizes as $size): ?>
                <option value="<?php echo $size; ?>" <?php if ($selected_size == $size) echo 'selected'; ?>><?php echo $size; ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Filter</button>
    </form>
    <div class="products">
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <div class="product">
                <a href="product_detail.php?id=<?php echo $row['id']; ?>">
                    <p><?php echo $row['name']; ?></p>
                </a>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>