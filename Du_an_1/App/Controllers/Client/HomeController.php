<?php

namespace App\Controllers\Client;

use App\Helpers\NotificationHelper;
use App\Views\Client\Components\Notification;
use App\Views\Client\Layouts\Footer;
use App\Views\Client\Home;
use App\Views\Client\Layouts\Header;

class HomeController
{
    // hiển thị trang home
    public static function index()
    {
        Header::render();
        Notification::render();  // hiển thị thông báo
        NotificationHelper::clear(); //clear notification
        Home::render();
        Footer::render();
    }
}