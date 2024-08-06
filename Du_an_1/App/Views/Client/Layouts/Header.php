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
        
        $current_page = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $current_page = trim($current_page, '/'); // Loại bỏ dấu gạch chéo ở đầu và cuối
        if ($current_page == '') {
            $current_page = 'home'; // Trang chủ mặc định nếu đường dẫn trống
        }


?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>

                    <!-- Google Web Fonts -->
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet"> 

            <!-- Icon Font Stylesheet -->
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

            <!-- Libraries Stylesheet -->
            <link href="<?= APP_URL ?>/public/assets/client/lib/lightbox/css/lightbox.min.css" rel="stylesheet">
            <link href="<?= APP_URL ?>/public/assets/client/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

            
            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
            <link rel="stylesheet" href="/public/assets/font-awesome-4.7.0/css/font-awesome.min.css">
            <!-- <link rel="stylesheet" href="<?= APP_URL ?>/public/assets/client/css/style.css"> -->
            <link rel="stylesheet" href="<?= APP_URL ?>/public/assets/client/css/style2.css">
            <link rel="stylesheet" href="<?= APP_URL ?>/public/assets/client/css/bootstrap.min.css">
            <script src="<?= APP_URL ?>/public/assets/client/lib/main/main.js"></script>

        </head>

        <body>

        <!-- Spinner Start -->
        <div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
            <div class="spinner-grow text-primary" role="status"></div>
        </div>
        <!-- Spinner End -->

            <!-- Navbar start -->
            <nav>
        <div class="container-fluid fixed-top" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            <div class="container px-0">
                <nav class="navbar navbar-light bg-white navbar-expand-xl">
                    <a href="/" class="navbar-brand"><h1 class="text-primary display-6">NMC Store</h1></a>
                    <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                        <span class="fa fa-bars text-primary"></span>
                    </button>
                    <div class="collapse navbar-collapse bg-white nav-pills" id="navbarCollapse">
                        <div class="navbar-nav mx-auto">
                            <a href="/" class="nav-item nav-link <?= ($current_page == 'home') ? 'active' : '' ?>">Trang chủ</a>
                            <a href="/products" class="nav-item nav-link <?= ($current_page == 'products') ? 'active' : '' ?>">Sản phẩm</a>
                            <a href="/contact" class="nav-item nav-link <?= ($current_page == 'contact') ? 'active' : '' ?>">Liên hệ</a>
                            <a href="/cart" class="nav-item nav-link <?= ($current_page == 'cart') ? 'active' : '' ?>">Giỏ hàng</a>
                        

                        
                        </div>
                        <div class="d-flex m-3 me-0">
                            <button class="btn-search btn border border-secondary btn-md-square rounded-circle bg-white me-4" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fas fa-search text-primary"></i></button>
                            <a href="/cart" class="position-relative me-4 my-auto">
                                <i class="fa fa-shopping-bag fa-2x"></i>
                                <span class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1" style="top: -5px; left: 15px; height: 20px; min-width: 20px;">3</span>
                            </a>
                        </div>
                        <div class="d-flex m-3 me-0">
                            
                        <?php
                        if($is_login):
                        ?>
                            <div class="nav-item">
                                <div class="dropdown show">
                                        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-user fa-2x"></i>
                                        </a>

                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        
                                        <a class="dropdown-item" href="/users/<?=$_SESSION['user']['id']?>"><?=$_SESSION['user']['name']?></a>
                                        <a class="dropdown-item" href="/admin">Trang quản trị</a>
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

        <!-- Modal Search Start -->
        <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content rounded-3">
                    <div class="modal-header justify-content-center">
                        <h5 class="modal-title" id="exampleModalLabel">Tìm kiếm</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="position: absolute; right: 1rem;"></button>
                    </div>
                    <div class="modal-body d-flex align-items-center">
                        <div class="input-group w-75 mx-auto d-flex rounded-3">
                            <input type="search" class="form-control p-3" placeholder="Nhập từ khóa bạn cần tìm" aria-describedby="search-icon-1" style="border-radius: 0.5rem; height: 50px;">
                            <span id="search-icon-1" class="input-group-text p-3" style="border-radius: 0.5rem;"><i class="fa fa-search"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Search End -->
        <div style="height: 100px;"></div>

    <?php

    }
}

    ?>