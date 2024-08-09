<?php
namespace App\Controllers\Client;

use App\Helpers\NotificationHelper;
use App\Models\Cart;
use App\Views\Client\Components\Notification;
use App\Views\Client\Layouts\Footer;
use App\Views\Client\Layouts\Header;
use App\Views\Client\Pages\Cart\Index;
use App\Helpers\SessionHelper;
use App\Models\Product;

class CartController
{
    // hiển thị trang cart
    public static function index()
    {
        $cart = SessionHelper::get('cart', []);
        Header::render();
        Notification::render();  // hiển thị thông báo
        NotificationHelper::clear(); //clear notification
        Index::render($cart);
        Footer::render();
    }

    public static function addProduct()
    {
        // Lấy dữ liệu từ request
        $productId = isset($_POST['id']) ? (int)$_POST['id'] : null;
        $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;

        if (!$productId) {
            NotificationHelper::error('addProduct','ID sản phẩm không hợp lệ');
            // $_SESSION['error'] = 'ID sản phẩm không hợp lệ';
            header('Location: /cart');
            exit;
        }

        $getProduct = new Product();
        $product = $getProduct->getOneProduct($productId);

        if (!$product) {
            // Sản phẩm không tồn tại
            NotificationHelper::error('addProduct','Sản phẩm không tồn tại');
            // $_SESSION['error'] = 'Sản phẩm không tồn tại';
            header('Location: /cart');
            exit;
        }

        // Lấy giỏ hàng từ session
        $cart = SessionHelper::get('cart', []);

        // Thêm sản phẩm vào giỏ hàng
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'product' => $product,
                'quantity' => $quantity
            ];
        }

        // Lưu lại giỏ hàng vào session
        SessionHelper::set('cart', $cart);

        // Điều hướng về trang giỏ hàng
        header('Location: /cart');
        exit;
    }


    // Cập nhật số lượng sản phẩm trong giỏ hàng
    public static function updateQuantity() {
        try {
            $productId = $_POST['product_id'];
            $action = $_POST['action'];

            $cart = SessionHelper::get('cart', []);

            foreach ($cart as &$item) {
                if ($item['product']['id'] == $productId) {
                    if ($action == 'increase') {
                        $item['quantity']++;
                    } elseif ($action == 'decrease' && $item['quantity'] > 1) {
                        $item['quantity']--;
                    }
                    break;
                }
            }

            SessionHelper::set('cart', $cart);

            // Tính tổng số tiền
            $subtotal = array_sum(array_map(function($item) {
                return $item['product']['price'] * $item['quantity'];
            }, $cart));
            $total = $subtotal + 3; // Thêm phí vận chuyển cố định $3.00

            // Trả về JSON
            header('Content-Type: application/json');
            echo json_encode([
                'cart' => $cart,
                'subtotal' => number_format($subtotal, 2),
                'total' => number_format($total, 2)
            ]);
        } catch (\Exception $e) {
            header('Content-Type: application/json', true, 500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }



    // Xoá sản phẩm trong giỏ hàng
    public static function removeProduct()
    {
        $productId = $_POST['productId'];

        // Lấy giỏ hàng từ session
        $cart = SessionHelper::get('cart', []);

        // Xóa sản phẩm khỏi giỏ hàng
        foreach ($cart as $key => $item) {
            if ($item['product']['id'] == $productId) {
                unset($cart[$key]);
                break;
            }
        }

        // Cập nhật lại giỏ hàng trong session
        SessionHelper::set('cart', array_values($cart));

        // Tính toán lại giá tổng
        $newTotalPrice = array_sum(array_map(function($item) {
            return $item['product']['price'] * $item['quantity'];
        }, $cart));

        // Trả về dữ liệu cho AJAX
        echo json_encode(['newTotalPrice' => number_format($newTotalPrice, 2)]);
    }

    
    

}
