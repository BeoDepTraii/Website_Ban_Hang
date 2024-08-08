<?php
namespace App\Validations;

use App\Controllers\Client\CartController;
use App\Helpers\NotificationHelper;
use App\Models\Product;

class CheckoutValidation{

    public static function handleFormSubmission()
    {
        // Lấy dữ liệu từ request
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productId = isset($_POST['id']) ? (int)$_POST['id'] : null;
            $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;

            if (!$productId) {
                $errors[] = 'ID sản phẩm không hợp lệ';
            } else {
                $productModel = new Product();
                $product = $productModel->getOneProduct($productId);

                if (!$product) {
                    $errors[] = 'Sản phẩm không tồn tại';
                }
            }

            if (empty($errors)) {
                // Xử lý thêm sản phẩm vào giỏ hàng nếu không có lỗi
                CartController::addProduct();
            } else {
                foreach ($errors as $error) {
                    NotificationHelper::error('formHandler', $error);
                }
                header('Location: /cart');
                exit;
            }
        }
    }

    public static function store(){

        $is_valid = true;

        if(!isset($_POST['address']) || $_POST['address'] === ''){
            NotificationHelper::error('address', 'Không để trống địa chỉ !');
            $is_valid = false;
        }
        if(!isset($_POST['phonenumber']) || $_POST['phonenumber'] === ''){
            NotificationHelper::error('number', 'Không để trống số điện thoại !');
            $is_valid = false;
        }
        return $is_valid;
    }
}
?>