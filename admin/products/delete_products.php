<?php
    require '../../koneksi.php';
    session_start();
    if (!isset($_SESSION['login'])) {
        header("location: ../index.php");
        exit;
    }

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "DELETE FROM products WHERE id = ?";
        $stmt = $koneksi->prepare($query);
        $stmt->bind_param('i', $id);
        if ($stmt->execute()) {
            echo "Product deleted successfully";
            header("location: main_products.php");
            exit;
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
?>
