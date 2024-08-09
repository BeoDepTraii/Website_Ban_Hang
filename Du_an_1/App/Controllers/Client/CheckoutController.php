<?php

namespace App\Controllers\Client;

use App\Helpers\NotificationHelper;
use App\Helpers\SessionHelper;
use App\Models\Bill;
use App\Models\User;
use App\Views\Client\Components\Notification;
use App\Views\Client\Layouts\Footer;
use App\Views\Client\Layouts\Header;
use App\Views\Client\Pages\Checkout\Index;
use App\Validations\CheckoutValidation;

class CheckoutController
{
    // hiển thị trang thanh toán
    public static function index()
    {        

        $data=$_SESSION['user'];
        Header::render();
        Notification::render();  // hiển thị thông báo
        NotificationHelper::clear(); //clear notification
        Index::render($data);
        Footer::render();
    }

    public static function getCartData()
    {
        // Lấy giỏ hàng từ session
        $cart = SessionHelper::get('cart', []);

        // echo '<pre>';
        // var_dump($cart);

        // Tính toán giá tổng
        $totalPrice = array_sum(array_map(function($item) {
            return $item['product']['price'] * $item['quantity'];
        },
        $cart));

        
        
        return [
            'cart' => $cart,
            'totalPrice' => number_format($totalPrice, 2)
        ];
    }
    public static function store()
    {
        //Validate
        $is_valid = CheckoutValidation::store();

        if(!$is_valid){
            NotificationHelper::error('store', 'Đặt hàng thất bại');
            header('Location: /checkout');
            exit;
        }
        //Thêm vào CSDL
        $data=[
            //  'username' => $_POST['id'],
            'address' => $_POST['address'],
            'phonenumber' => $_POST['phonenumber'], 
        ];
        $bill = new Bill();
        $result = $bill->createBill($data);

        if($result){
            NotificationHelper::success('store', 'Đặt hàng thành công!');
            header('Location: /checkout');
            exit;
        }else{
            NotificationHelper::error('store', 'Đặt hàng thất bại!');
            header('Location: /checkout');
            exit;
        }
    }
}