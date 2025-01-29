<?php
    require '../koneksi.php';
    session_start();

    if (isset($_GET['action']) && isset($_GET['index'])) {
        $action = $_GET['action'];
        $index = $_GET['index'];

        if (isset($_SESSION['cart'][$index])) {
            if ($action == 'decrease') {
                // Decrease quantity
                if ($_SESSION['cart'][$index]['quantity'] > 1) {
                    $_SESSION['cart'][$index]['quantity']--;
                } else {
                    // Remove item if quantity is 1
                    unset($_SESSION['cart'][$index]);
                }
            } elseif ($action == 'remove') {
                // Remove item
                unset($_SESSION['cart'][$index]);
            }
        }
    }

    // Redirect back to cart page
    header("location: cart.php");
    exit;
?>