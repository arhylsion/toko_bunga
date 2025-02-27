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
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .product-price {
            font-size: 1.5rem;
            font-weight: bold;
            color:rgb(0, 0, 0);
        }
        .product-stock {
            font-size: 0.9rem;
            color:rgb(0, 0, 0);
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <img src="../<?php echo $product['image_url']; ?>" class="img-fluid" alt="<?php echo $product['name']; ?>">
            </div>
            <div class="col-md-6">
                <h1 class="mb-4"><?php echo $product['name']; ?></h1>
                <p class="product-price">Price: <?php echo $product['price']; ?></p>
                <p class="product-stock">Stock: <?php echo $product['stock']; ?></p>
                <form action="add_to_cart.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
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
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add to Cart</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>