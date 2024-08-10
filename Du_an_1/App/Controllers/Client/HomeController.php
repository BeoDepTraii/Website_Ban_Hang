<?php

namespace App\Controllers\Client;

use App\Helpers\NotificationHelper;
use App\Models\Category;
use App\Models\Product;
use App\Views\Client\Components\Notification;
use App\Views\Client\Layouts\Footer;
use App\Views\Client\Home;
use App\Views\Client\Layouts\Header;

class HomeController
{
    // hiển thị trang home
    public static function index()
    {
        $category = new Category();
        $categories = $category->getAllCategoryByStatus();

        $product = new Product();
        $products = $product->getAllProductByStatus();
        $data = [
            'products' => $products,
            'categories' => $categories
        ];
        Header::render();
        Notification::render();  // hiển thị thông báo
        NotificationHelper::clear(); //clear notification
        Home::render($data);
        Footer::render();
    }
}
