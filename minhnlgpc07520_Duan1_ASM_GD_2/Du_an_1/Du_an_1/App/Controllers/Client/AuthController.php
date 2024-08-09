<?php

namespace App\Controllers\Client;

use App\Helpers\AuthHelper;
use App\Helpers\NotificationHelper;
use App\Models\User;
use App\Validations\AuthValidation;
use App\Views\Client\Components\Notification;
use App\Views\Client\Layouts\Footer;
use App\Views\Client\Layouts\Header;
use App\Views\Client\Pages\Auth\ChangePassword;
use App\Views\Client\Pages\Auth\Edit;
use App\Views\Client\Pages\Auth\ForgotPassword;
use App\Views\Client\Pages\Auth\Login;
use App\Views\Client\Pages\Auth\Register;
use App\Views\Client\Pages\Auth\ResetPassword;

class AuthController {


    /*------------------CHỨC NĂNG ĐĂNG KÝ-------------------*/

    // Hiển thị giao diện form đăng kí
    public static function register(){


        // Render giao diện
        Header::render();
        Notification::render();  // hiển thị thông báo
        NotificationHelper::clear(); //clear notification
        Register::render(); // Render register 
        Footer::render();

    }

    //Xử lí form đăng kí
    public static function registerAction(){
        //Validate


        //Kiểm tra thoả điều kiện ko? Có->tiếp tục chạy lệnh dưới  Ko (có lỗi)->thông báo & chuyển hướng về trang đăng ký

        $is_valid=AuthValidation::register();

        if(!$is_valid){
            NotificationHelper::error('register_invalid', 'Đăng kí thất bại !');
            header('Location: /register');
            exit();
        }

        //Lấy dữ liệu từ form do người dùng nhập vào
        $username=$_POST['username'];
        $password=$_POST['password'];
        $hash_password=password_hash($password,PASSWORD_DEFAULT);
        $email=$_POST['email'];
        $name=$_POST['name'];

        //Đưa dữ liệu vào mảng, lưu ý: "key" phải trùng với CSDL
        $data=[
            'username'=>$username,
            'password'=>$hash_password,
            'email'=>$email,
            'name'=>$name,
        ];

        $result=AuthHelper::register($data);
        if($result){
            header('Location: /login');
        }else{
            header('Location: /register');
        }

    }




    /*------------------CHỨC NĂNG ĐĂNG NHẬP-------------------*/
    
    // Hiển thị giao diện form đăng nhập
    public static function login(){
        // Render giao diện
        Header::render();
        Notification::render();  // hiển thị thông báo
        NotificationHelper::clear(); //clear notification
        Login::render();
        Footer::render();
    }


    // Xử lí form đăng nhập
    public static function loginAction(){
        
        //Validate

        $is_valid=AuthValidation::login();

        if(!$is_valid){
            NotificationHelper::error('login', 'Đăng nhập thất bại!');
            header('Location: /login');
            exit;
        }

        $data=[
            'username' => $_POST['username'],
            'password' => $_POST['password'],
            'remember' => isset($_POST['remember'])
        ];


        $result=AuthHelper::login($data);
        if($result){
            // NotificationHelper::success('login','Đăng nhập thành công !');
            header('Location: /');
        } else{
            // NotificationHelper::error('login','Đăng nhập thất bại !');
            header('Location: /login');
        }
    }




    /*------------------CHỨC NĂNG ĐĂNG XUẤT-------------------*/
    // Đăng xuất
    public static function logout(){
        AuthHelper::logout();
        NotificationHelper::success('logout','Đăng xuất thành công !');
        header('Location: /');
    }

    public static function edit($id){
        $result = AuthHelper::edit($id);

        if (!$result) {

            if(isset($_SESSION['error']['login'])){
                header('Location: /login');
                exit;
            }
            if(isset($_SESSION['error']['user_id'])){

                $data=$_SESSION['user'];
                $user_id=$data['id'];
                header("Location: /users/$user_id");
                exit;
            }
        }


        $data=$_SESSION['user'];
        Header::render();
        Notification::render();  // hiển thị thông báo
        NotificationHelper::clear(); //clear notification

        //Giao diện thông tin user
        Edit::render($data); //Render data user
        Footer::render();



    }



    /*------------------CHỨC NĂNG CẬP NHẬT-------------------*/
    public static function update($id){
        //Validate
        $is_valid=AuthValidation::edit();

        if(!$is_valid){
            NotificationHelper::error('update_user', 'Cập nhật thất bại!');
            header("Location: /users/$id");
            exit;
        }

        //Đưa dữ liệu vào mảng
        $data=[
            'email'=>$_POST['email'],
            'name'=>$_POST['name'],
        ];


        //Kiểm tra có upload hình ảnh ko?   Có->kiểm tra tính hợp lệ của file
        $is_upload = AuthValidation::uploadAvatar();
        if($is_upload){
            $data['avatar'] = $is_upload;
        }


        //Gọi Helper để Update
        $result=AuthHelper::update($id, $data);

        //Kiểm tra kết quả trả về và chuyển hướng
        header("Location: /users/$id");

    }



    /*------------------CHỨC NĂNG ĐỔI MẬT KHẨU-------------------*/
    //Hiển thị form đổi mật khẩu
    public static function changePassword(){
        $is_login = AuthHelper::checkLogin();

        if (!$is_login) {
            NotificationHelper::error('login', 'Vui lòng đăng nhập để đổi mật khẩu !');
            header('Location: /login');
            exit;
        }

        $data = $_SESSION['user'];

        Header::render();
        Notification::render();  // hiển thị thông báo
        NotificationHelper::clear(); //clear notification
        ChangePassword::render($data);
        Footer::render();     

    }


    //Thực hiện đổi mật khẩu
    public static function changePasswordAction(){
        //Validate

        $is_valid = AuthValidation::changePassword();

        if(!$is_valid){
            NotificationHelper::error('change_password', 'Cập nhật mật khẩu thất bại!');
            header('Location: /change-password');
            exit;
        }


        //Lấy id người dùng hiện tại từ session hiện tại  (id đã đăng nhập)  và đưa vào mảng dữ liệu
        $id= $_SESSION['user']['id'];

        $data=[
            'old_password' => $_POST['old_password'],
            'new_password' => $_POST['new_password'],
        ];

        

        //Gọi Helper để Update
        $result=AuthHelper::changePassword($id, $data);

        //Kiểm tra kết quả trả về và chuyển hướng
        header('Location: /change-password');
    }





    /*------------------CHỨC NĂNG QUÊN MẬT KHẨU-------------------*/
    //Hiển thị giao diện quên mật khẩu

    public static function forgotPassword(){
        Header::render();
        Notification::render();  // hiển thị thông báo
        NotificationHelper::clear(); //clear notification
        ForgotPassword::render();
        Footer::render();
    }

    //Thực hiện lấy lại mật khẩu
    public static function forgotPasswordAction(){
        //Validate
        $is_valid=AuthValidation::forgotPassword();

        if(!$is_valid){
            NotificationHelper::error('forgot_password', 'Lấy lại mật khẩu thất bại!');
            header('Location: /forgot-password');
            exit;
        }

        //Lấy dữ liệu từ form do người dùng nhập vào
        $username=$_POST['username'];
        $email=$_POST['email'];

        $data=[
            'username' => $username
        ];

        //Kiểm tra username, email đã tồn tại trong CSDL chưa?
        $result=AuthHelper::forgotPassword($data);

        if(!$result){
            NotificationHelper::error('username_exist','Không tồn tại tài khoản này!');
            header('Location: /forgot-password');
            exit;
        }

        if($result['email']!=$email){
            NotificationHelper::error('email_incorrect','Email nhập không đúng!');
            header('Location: /forgot-password');
            exit;
        }

        $_SESSION['reset_password'] = [
            'username' => $username,
            'email' => $email
        ];

        header('Location: /reset-password');

    }


        //Hiển thị giao diện reset mật khẩu

        public static function resetPassword(){
            if(!isset($_SESSION['reset_password'])){
                NotificationHelper::error('reset_password', 'Vui lòng nhập đầy đủ thông tin của form này!');
                header('Location: /forgot-password');
                exit;
            }
            Header::render();
            Notification::render();  // hiển thị thông báo
            NotificationHelper::clear(); //clear notification
            ResetPassword::render();
            Footer::render();
        }

        //Thực hiện reset mật khẩu
        public static function resetPasswordAction(){
            //Validate
            $is_valid=AuthValidation::resetPassword();

            if(!$is_valid){
                NotificationHelper::error('reset_password', 'Đặt lại mật khẩu thất bại!');
                header('Location: /reset-password');
                exit;
            }

            //Lấy dữ liệu từ form do người dùng nhập vào
            $password=$_POST['password'];
            $hash_password=password_hash($password,PASSWORD_DEFAULT);
            $data=[
                'username' => $_SESSION['reset_password']['username'],
                'email' => $_SESSION['reset_password']['email'],
                'password' => $hash_password
            ];

            //Gọi Helper để Update
            $result=AuthHelper::resetPassword($data);

            if($result){
                NotificationHelper::success('reset_password','Đặt lại mật khẩu thành công!');
                unset($_SESSION['reset_password']);
                header('Location: /login');
            }else{
                NotificationHelper::error('reset_password','Đặt lại mật khẩu thất bại!');
                header('Location: /reset-password');
            }
            //Kiểm tra kết quả trả về và chuyển hướng
            header('Location: /login');

        }


}