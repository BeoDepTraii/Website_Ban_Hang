<?php

namespace App\Views\Client\Layouts;

use App\Helpers\AuthHelper;
use App\Views\BaseView;

class Header extends BaseView
{
    public static function render($data = null)
    {
        // unset($_SESSION['user']);
        // echo('<pre>');
        // var_dump($_SESSION['user']);
        // var_dump(json_decode($_COOKIE['user']));

        $is_login = AuthHelper::checkLogin();


?>


        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
            <!-- <link rel="stylesheet" href="<?= APP_URL ?>/public/assets/client/css/style.css"> -->
            <link rel="stylesheet" href="<?= APP_URL ?>/public/assets/client/css/style2.css">
            <link rel="stylesheet" href="<?= APP_URL ?>/public/assets/client/css/bootstrap.min.css">

        </head>

        <body>

            <!-- Navbar start -->
            <nav>
        <div class="container-fluid fixed-top">
            <div class="container px-0">
                <nav class="navbar navbar-light bg-white navbar-expand-xl">
                    <a href="index.html" class="navbar-brand"><h1 class="text-primary display-6">Fruitables</h1></a>
                    <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                        <span class="fa fa-bars text-primary"></span>
                    </button>
                    <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                        <div class="navbar-nav mx-auto">
                            <a href="/" class="nav-item nav-link active">Trang chủ</a>
                            <a href="/products" class="nav-item nav-link">Sản phẩm</a>
                            <a href="shop-detail.html" class="nav-item nav-link">Liên hệ</a>
                            <a href="contact.html" class="nav-item nav-link">Giỏ hàng</a>
                        

                        
                        </div>
                        <div class="d-flex m-3 me-0">
                            
                        <?php
                        if($is_login):
                        ?>
                            <div class="nav-item">
                                <div class="dropdown show">
                                        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Tài khoản
                                        </a>

                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        
                                        <a class="dropdown-item" href="/users/<?=$_SESSION['user']['id']?>"><?=$_SESSION['user']['username']?></a>
                                        <a class="dropdown-item" href="/change-password">Đổi mật khẩu</a>
                                        <a class="dropdown-item" href="/logout">Đăng xuất</a>
                                        
                                    </div>
                                </div>

                            </div>
                            
                        <?php
                        else:
                        ?>
                            <div class="nav-item">
                                <a class="nav-link" href="/login">Đăng nhập</a>
                            </div>
                            <div class="nav-item">
                                <a class="nav-link" href="/register">Đăng ký</a>
                            </div>
                        <?php
                        endif;
                        ?>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        </nav>
        <!-- Navbar End -->

        <div class="space" style="height: 100px;"></div>

    <?php

    }
}

    ?>