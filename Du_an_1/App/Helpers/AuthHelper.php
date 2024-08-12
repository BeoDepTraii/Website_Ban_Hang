<?php

namespace App\Helpers;

use App\Models\User;

class AuthHelper {
    public static function register($data){


                //Kiểm tra có tồn tại username trong database?   Có->thông báo, trả về false
                $user= new User();

                //Bắt lỗi tồn tại username
                $is_exist=$user->getOneUserByUsernamme($data['username']);
                if($is_exist){
                    NotificationHelper::error('exist_register','Tên đăng nhập đã tồn tại! Vui lòng chọn tên khác !');
                    return false;
                }

                //Tạo user mới và thêm vào database qua "createUser"
                
                $result=$user->createUser($data);


                if($result){
                    NotificationHelper::success('register','Đăng kí thành công!');
                    return true;
                }
                NotificationHelper::error('register','Đăng kí thất bại!');
                return false;

    }



    public static function login($data){

                //Kiểm tra có tồn tại username trong database?   Ko->thông báo, trả về false
                $user=new User();

                //Bắt lỗi tồn tại username
                $is_exist=$user->getOneUserByUsernamme($data['username']);
                if(!$is_exist){
                    NotificationHelper::error('username','Tên đăng nhập không tồn tại!');
                    return false;
                }



                // Có -> kiểm tra passwword có trùng ko?   Ko ->thông báo, trả về false
                //pass người dùng nhập: $data['password']
                //pass trong csdl: $is_exist['password']
                if(!password_verify($data['password'],$is_exist['password'])){
                    NotificationHelper::error('password','Mật khẩu không đúng!');
                    return false;
                }


                // Có -> kiểm tra status == 1 ?   Ko->thông báo, trả về false
                if($is_exist['status']==0){
                    NotificationHelper::error('status','Tài khoản đã bị khoá !');
                    return false;
                }

                
                // Có -> kiểm tra remember? lưu session/cookie -> thông báo thành công, trả về true
                if($data['remember']){
                     //Lưu session, cookie
                    self::updateCookie($is_exist['id']);


                }else{
                    //Lưu session
                    self::updateSession($is_exist['id']);
                }

                NotificationHelper::success('login','Đăng nhập thành công!');
                return true;
    }


    //Cập nhật cookie
    public static function updateCookie(int $id){
        ob_start();
        $user=new User();
        $result=$user->getOneUser($id);

        if($result){
            //Chuyển array thành string json để lưu vào cookie user
            $user_data=json_encode($result);
                    

            //Lưu cookie
            setcookie('user', $user_data, time() + 3600*24*30*12, '/'); 
                     

            //Lưu session
            $_SESSION['user'] = $result;
        }
    }


    //Cập nhật SESSION
    public static function updateSession(int $id){
        $user=new User();
        $result=$user->getOneUser($id);

        if($result){
            //Lưu session
            $_SESSION['user']=$result;
        }
    }


    //Kiểm tra đăng nhập
    public static function checkLogin():bool{
        if(isset($_COOKIE['user'])){
            $user=$_COOKIE['user'];
            $user_data=(array)json_decode($user);

            self::updateCookie($user_data['id']);
            // $_SESSION['user']=(array)$user_data;
            return true;
        }

        if(isset($_SESSION['user'])){
            self::updateSession($_SESSION['user']['id']);
            return true;
        }
        return false;
    }



    //Đăng xuất
    public static function logout(){


        //Xóa session
        if(isset($_SESSION['user'])){
            unset($_SESSION['user']);
        }

        //Xóa cookie
        if(isset($_COOKIE['user'])){
            setcookie('user', '', time() - 3600*24*30*12, '/');
        }
    }


    public static function edit($id):bool{


        if(!self::checkLogin()){
            NotificationHelper::error('login', 'Vui lòng đăng nhập để xem thông tin !');
            return false;
        }

        $data=$_SESSION['user'];

        $user_id=$data['id'];

        if(isset($_COOKIE['user'])){
            self::updateCookie($user_id);
        }

        self::updateSession($user_id);

        if($user_id!=$id){
            NotificationHelper::error('user_id', 'Bạn không có quyền xem thông tin tài khoản này !');

            return false;
        }

        return true;
    }



    public static function update($id, $data){

        $user=new User();

        $result=$user->updateUser($id, $data);

        if(!$result){
            NotificationHelper::error('update_user', 'Cập nhật thất bại!');
            return false;
           
        }

        if($_SESSION['user']){
            self::updateSession($id);
        }

        if($_COOKIE['user']){
            self::updateCookie($id);
        }

        NotificationHelper::success('update_user', 'Cập nhật thành công!');
        return true;
        
    }


    public static function changePassword($id, $data){
        //Kiểm tra mật khẩu cũ có trùng khớp với CSDL
        $user=new User();

        $result=$user->getOneUser($id);

        if(!password_verify($data['old_password'],$result['password'])){
            NotificationHelper::error('password_verify', 'Mật khẩu cũ không đúng!');
            return false;
        }

        
        if(!$result){
            NotificationHelper::error('account', 'Tài khoản không tồn tại!');
            return false;
        }

        //Cập nhật mật khẩu mới vào CSDL, mã hoá mk trc khi lưu
        $hash_password = password_hash($data ['new_password'], PASSWORD_DEFAULT);

        $data_update=[
            'password'=>$hash_password,
        ];


        $result_update=$user->updateUser($id, $data_update);


        if($result_update){
            if(isset($_COOKIE['user'])){
                self::updateCookie($id);
            }
                self::updateSession($id);
                NotificationHelper::success('change_password', 'Đổi mật khẩu thành công!');
                return true;
        }else{
            NotificationHelper::error('change_password', 'Đổi mật khẩu thất bại!');
            return false;
        }

        
    }


    public static function forgotPassword($data) {
        $user= new User();

        $result=$user->getOneUserByUsernamme($data['username']);

        return $result;
    }


    public static function resetPassword($data) {
        $user= new User();

        $result=$user->updateUserByUsernameAndEmail($data);

        return $result;
    }

    public static function middleware(){
        // var_dump($_SERVER['REQUEST_URI']);
        $admin=explode('/',$_SERVER['REQUEST_URI']);
        // var_dump($admin);
        $admin=$admin[1];

        if($admin=='admin'){

            if(!isset($_SESSION['user'])){
                NotificationHelper::error('admin', 'Vui lòng đăng nhập trước!');
                header('Location: /login');
                exit;
            }

            if($_SESSION['user']['role'] != 1 ){
                NotificationHelper::error('admin', 'Bạn không có quyền truy cập trang này!');
                header('Location: /login');
                exit;
            }
        }
    }

    
}