<?php
session_start();

// Lấy ID sản phẩm từ query parameter
$productId = $_GET['product_id'] ?? '';

// Kiểm tra xem ID sản phẩm có tồn tại trong giỏ hàng không
if ($productId) {
    $cart = $_SESSION['cart'] ?? [];

    if (isset($cart[$productId])) {
        unset($cart[$productId]); // Xóa sản phẩm khỏi giỏ hàng
    }

    $_SESSION['cart'] = $cart;

    // Chuyển hướng trở lại trang giỏ hàng
    header('Location: /cart');
    exit;
}
?>
