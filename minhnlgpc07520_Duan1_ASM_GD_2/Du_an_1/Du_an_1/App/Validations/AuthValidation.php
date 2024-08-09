<?php


namespace App\Validations;

use App\Helpers\NotificationHelper;

class AuthValidation{



    /*------------------CHỨC NĂNG ĐĂNG KÝ-------------------*/

    public static function register():bool{
        $is_valid = true;

        
        //Validate tên đăng nhập
        if(!isset($_POST['username']) || $_POST['username'] === ''){
            NotificationHelper::error('username', 'Không để trống tên đăng nhập !');
            $is_valid = false;
        }



        //Validate mật khẩu
        if(!isset($_POST['password']) || $_POST['password'] === ''){
            NotificationHelper::error('password', 'Không để trống mật khẩu !');
            $is_valid = false;
        }else{
            if(strlen($_POST['password'])<3){
                NotificationHelper::error('password','Mật khẩu phải trên 3 kí tự !');
                $is_valid = false;

            }
        }




        //Validate confirm password
        if(!isset($_POST['confirmPassword']) || $_POST['confirmPassword'] === ''){
            NotificationHelper::error('confirmPassword', 'Không để trống mục nhập lại mật khẩu !');
            $is_valid = false;
        }else{
            if($_POST['password']!=$_POST['confirmPassword']){
                NotificationHelper::error('confirmPassword','Mật khẩu và nhập lại mật khẩu chưa giống nhau !');
                $is_valid = false;

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







    /*------------------CHỨC NĂNG ĐĂNG NHẬP-------------------*/

    public static function login():bool{
        $is_valid = true;

        
        //Validate tên đăng nhập
        if(!isset($_POST['username']) || $_POST['username'] ===''){
            NotificationHelper::error('username', 'Không để trống tên đăng nhập !');
            $is_valid = false;
        }



        //Validate mật khẩu
        if(!isset($_POST['password']) || $_POST['password'] ===''){
            NotificationHelper::error('password', 'Không để trống mật khẩu !');
            $is_valid = false;
        }

        return $is_valid;

    }




       /*------------------CHỨC NĂNG UPDATE-------------------*/

       public static function edit():bool{
        $is_valid = true;



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



    //Upload file avt
    public static function uploadAvatar() {
        // Check if file has been uploaded
        if (!file_exists($_FILES['avatar']['tmp_name']) || !is_uploaded_file($_FILES['avatar']['tmp_name'])) {
            // NotificationHelper::error('avatar', 'Vui lòng chọn ảnh đại diện!');
            return false;
        }
    
        // Directory to store uploaded images
        $target_dir = 'public/uploads/users/';
    
        // Check file type
        $imageFileType = strtolower(pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION));
        if ($imageFileType != 'jpg' && $imageFileType != 'jpeg' && $imageFileType != 'png' && $imageFileType != 'gif') {
            NotificationHelper::error('type_upload', 'Chỉ cho phép upload file ảnh JPG, JPEG, PNG, GIF!');
            return false;
        }
    
        // Generate a new name for the image file based on date and extension
        $nameImage = date('YmdHis') . '.' . $imageFileType;
    
        // Full path to move the uploaded file to
        $target_file = $target_dir . $nameImage;
    
        // Move the uploaded file to the destination directory
        if (!move_uploaded_file($_FILES['avatar']['tmp_name'], $target_file)) {
            NotificationHelper::error('move_upload', 'Không thể tải ảnh vào thư mục đã lưu trữ!');
            return false;
        }
    
        // Return the filename if upload is successful
        return $nameImage;
    }






        /*------------------CHỨC NĂNG ĐỔI MẬT KHẨU-------------------*/

        public static function changePassword():bool{
            $is_valid = true;
    
    

            //Validate mật khẩu cũ
            if(!isset($_POST['old_password']) || $_POST['old_password'] === ''){
                NotificationHelper::error('old_password', 'Không để trống mật khẩu cũ !');
                $is_valid = false;
            }


    
            //Validate mật khẩu mới
            if(!isset($_POST['new_password']) || $_POST['new_password'] === ''){
                NotificationHelper::error('new_password', 'Không để trống mật khẩu mới !');
                $is_valid = false;
            }else{
                if(strlen($_POST['new_password'])<3){
                    NotificationHelper::error('new_password','Mật khẩu mới phải trên 3 kí tự !');
                    $is_valid = false;
    
                }
            }
    
    
    
    
            //Validate confirm password mới
            if(!isset($_POST['confirmPassword']) || $_POST['confirmPassword'] === ''){
                NotificationHelper::error('confirmPassword', 'Không để trống mục nhập lại mật khẩu mới !');
                $is_valid = false;
            }else{
                if($_POST['new_password']!=$_POST['confirmPassword']){
                    NotificationHelper::error('confirmPassword','Mật khẩu mới và nhập lại mật khẩu mới chưa giống nhau !');
                    $is_valid = false;
    
                }
            }

    
    
            return $is_valid;
    
        }



    
            /*------------------CHỨC NĂNG QUÊN MẬT KHẨU-------------------*/

    public static function forgotPassword():bool{
        $is_valid = true;

        
        //Validate tên đăng nhập
        if(!isset($_POST['username']) || $_POST['username'] === ''){
            NotificationHelper::error('username', 'Không để trống tên đăng nhập !');
            $is_valid = false;
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



        return $is_valid;

    }


    //Reset password
    public static function resetPassword():bool{
        $is_valid = true;



        //Validate mật khẩu
        if(!isset($_POST['password']) || $_POST['password'] === ''){
            NotificationHelper::error('password', 'Không để trống mật khẩu !');
            $is_valid = false;
        }else{
            if(strlen($_POST['password'])<3){
                NotificationHelper::error('password','Mật khẩu phải trên 3 kí tự !');
                $is_valid = false;

            }
        }




        //Validate confirm password
        if(!isset($_POST['confirmPassword']) || $_POST['confirmPassword'] === ''){
            NotificationHelper::error('confirmPassword', 'Không để trống mục nhập lại mật khẩu !');
            $is_valid = false;
        }else{
            if($_POST['password']!=$_POST['confirmPassword']){
                NotificationHelper::error('confirmPassword','Mật khẩu và nhập lại mật khẩu chưa giống nhau !');
                $is_valid = false;

            }
        }


        return $is_valid;

    }
}