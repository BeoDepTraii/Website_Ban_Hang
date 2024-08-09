<?php
session_start();

if (isset($_POST['product_id']) && isset($_GET['action'])) {
    $productId = $_POST['product_id'];
    $action = $_GET['action'];

    $cart = $_SESSION['cart'] ?? [];

    if (isset($cart[$productId])) {
        if ($action === 'increase') {
            $cart[$productId]['quantity']++;
        } elseif ($action === 'decrease') {
            if ($cart[$productId]['quantity'] > 1) {
                $cart[$productId]['quantity']--;
            }
        }
    }

    $_SESSION['cart'] = $cart;

    // Chuyển hướng về trang giỏ hàng sau khi cập nhật
    header('Location: /cart');
    exit;
}
