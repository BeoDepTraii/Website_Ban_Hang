<?php

namespace App\Controllers\Client;

use App\Helpers\NotificationHelper;
use App\Models\Cart;
use App\Views\Client\Components\Notification;
use App\Views\Client\Layouts\Footer;
use App\Views\Client\Layouts\Header;
use App\Views\Client\Pages\Cart\Index;

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

    // public function addProduct($product) {
    //     $cart = new Cart();
    //     $cart->add($product);
    //     header("Location: /cart");
    //     exit();
    // }

    // public function showCart() {
    //     $cart = new Cart();
    //     $cartItems = $cart->getCart();
    //     Index::render($cartItems);
    // }
}