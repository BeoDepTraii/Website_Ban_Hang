<?php
session_start();

// Kiểm tra xem có yêu cầu cập nhật số lượng không
if (isset($_POST['product_id']) && isset($_POST['action'])) {
    $productId = $_POST['product_id'];
    $action = $_POST['action'];

    // Lấy giỏ hàng từ session
    $cart = $_SESSION['cart'] ?? [];

    // Cập nhật số lượng sản phẩm
    if (isset($cart[$productId])) {
        if ($action === 'increase') {
            $cart[$productId]['quantity']++;
        } elseif ($action === 'decrease') {
            // Đảm bảo số lượng không giảm dưới 1
            if ($cart[$productId]['quantity'] > 1) {
                $cart[$productId]['quantity']--;
            }
        }
    }

    // Cập nhật giỏ hàng trong session
    $_SESSION['cart'] = $cart;

    // Trả về giỏ hàng cập nhật dưới dạng JSON
    header('Content-Type: application/json');
    echo json_encode(['success' => true, 'cart' => $cart]);
    exit;
}
