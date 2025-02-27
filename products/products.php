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
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Toko Bunga</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../users/index.php">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="" class="rounded-circle" alt="">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="logout.php">Logout</a>   
                        <a class="dropdown-item" href="change_address.php">Change Address</a>
                        <a class="dropdown-item" href="order_status.php">Order Status</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Product Dashboard</h1>
        <form method="get" action="" class="mb-4">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="order_type">Order Type</label>
                    <select name="order_type" id="order_type" class="form-control">
                        <option value="">All</option>
                        <?php foreach ($order_types as $type): ?>
                            <option value="<?php echo $type; ?>" <?php if ($selected_order_type == $type) echo 'selected'; ?>><?php echo $type; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="color">Color</label>
                    <select name="color" id="color" class="form-control">
                        <option value="">All</option>
                        <?php foreach ($colors as $color): ?>
                            <option value="<?php echo $color; ?>" <?php if ($selected_color == $color) echo 'selected'; ?>><?php echo $color; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="size">Size</label>
                    <select name="size" id="size" class="form-control">
                        <option value="">All</option>
                        <?php foreach ($sizes as $size): ?>
                            <option value="<?php echo $size; ?>" <?php if ($selected_size == $size) echo 'selected'; ?>><?php echo $size; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>
        <section>
            <h2 class="text-center mb-4">All Products</h2>
            <div class="row">
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <img src="<?php echo $row['image_url']; ?>" class="card-img-top" alt="<?php echo $row['name']; ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['name']; ?></h5>
                                <p class="card-text">Color: <span style="display:inline-block;width:20px;height:20px;background-color:<?php echo $row['color']; ?>;"></span></p>
                                <a href="product_detail.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">View Product</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </section>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>