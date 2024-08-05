<?php

namespace App\Validations;

use App\Helpers\NotificationHelper;

class UserValidation {

    public static function edit():bool {

        $is_valid = true;
        //Validate mật khẩu
        if(isset($_POST['password']) && $_POST['password'] !== ''){
            if(strlen($_POST['password'])<3){
                NotificationHelper::error('password','Mật khẩu phải trên 3 kí tự !');
                $is_valid = false;
            }
                //Validate confirm password
            if(!isset($_POST['re_password']) || $_POST['re_password'] === ''){
                NotificationHelper::error('re_password', 'Không để trống mục nhập lại mật khẩu !');
                $is_valid = false;
            }else{
                if($_POST['password']!=$_POST['re_password']){
                    NotificationHelper::error('re_password','Mật khẩu và nhập lại mật khẩu chưa giống nhau !');
                    $is_valid = false;

                }
        }
    }
        
        //Validate email
        if(!isset($_POST['email']) || $_POST['email'] === ''){
            NotificationHelper::error('email', 'Không để trống email !');
            $is_valid = false;
        }else{
            $emailPattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
            if(!preg_match($emailPattern, $_POST['email'])){
                NotificationHelper::error('email','Email không đúng định dạng !');
                $is_valid = false;
            }
        }
        //Validate name
        if(!isset($_POST['name']) || $_POST['name'] === ''){
            NotificationHelper::error('name', 'Không để trống họ và tên !');
            $is_valid = false;
        }
        return $is_valid;
    }

    public static function uploadAvatar(){
        return AuthValidation::uploadAvatar();
    }
}