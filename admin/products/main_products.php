<?php   
    require '../../koneksi.php';

    session_start();
    if (!isset($_SESSION['login'])) {
        header("location: ../login.php");
        exit;
    }

    $query = "SELECT * FROM products";
    $result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
</head>
<body>
    <h1>Product List</h1>
    <a href="add_products.php">Add New Product</a>
    <table border="1">
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Order Type</th>
            <th>Color</th>
            <th>Size</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['price']; ?></td>
            <td><?php echo $row['stock']; ?></td>
            <td><?php echo $row['order_type']; ?></td>
            <td><?php echo $row['color']; ?></td>
            <td><?php echo $row['size']; ?></td>
            <td>
                <a href="edit_products.php?id=<?php echo $row['id']; ?>">Edit</a>
                <a href="delete_products.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
