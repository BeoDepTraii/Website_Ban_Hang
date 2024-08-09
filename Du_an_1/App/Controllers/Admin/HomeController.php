<?php

namespace App\Controllers\Admin;

use App\Helpers\NotificationHelper;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Product;
use App\Models\User;
use App\Views\Admin\Components\Notification;
use App\Views\Admin\Home;
use App\Views\Admin\Layouts\Footer;
use App\Views\Admin\Layouts\Header;

class HomeController
{
    // hiển thị thống kê
    public static function index()
    {
        // $user = new User();
        // $total_user = $user -> countTotalUser();

        // $category = new Category();
        // $total_category = $category -> countTotalCategory();

        // $product = new Product();
        // $total_product = $product -> countTotalPrduct();

        // $comment = new Comment();
        // $total_comment = $comment -> countTotalComment();

        // $product_by_category = $product->countProductByCaterogy();

        // $data =[
        //     'total_user'=> $total_user['total'],
        //     'total_category'=> $total_category['total'],
        //     'total_product'=> $total_product['total'],
        //     'product_by_category' => $product_by_category,
        //     'total_comment' => $total_comment['total']
        // ];
        // // echo '<pre>';
        // // var_dump($product_by_category);

        Header::render();
        Home::render($data);
        Footer::render();
    }
}
