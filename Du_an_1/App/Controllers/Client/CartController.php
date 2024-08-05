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
        Header::render();
        Notification::render();  // hiển thị thông báo
        NotificationHelper::clear(); //clear notification
        Index::render();
        Footer::render();
    }

    public function addProduct()
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
            NotificationHelper::error('addProduct','ID sản phẩm không hợp lệ');
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
}
