<?php
    require '../koneksi.php';
    session_start();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['id'];
        $order_type = $_POST['order_type'];
        $color = $_POST['color'];
        $size = $_POST['size'];
        $quantity = $_POST['quantity'];

        // Add to cart logic here
        $_SESSION['cart'][] = [
            'id' => $id,
            'order_type' => $order_type,
            'color' => $color,
            'size' => $size,
            'quantity' => $quantity
        ];

        // Redirect to cart page
        header("location: cart.php");
        exit;
    }
?>