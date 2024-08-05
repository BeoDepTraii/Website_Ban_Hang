<?php

namespace App\Controllers\Admin;

use App\Helpers\NotificationHelper;
use App\Models\User;
use App\Views\Admin\Layouts\Footer;
use App\Views\Admin\Layouts\Header;
use App\Views\Admin\Components\Notification;
use App\Views\Admin\Pages\User\Create;
use App\Views\Admin\Pages\User\Edit;
use App\Views\Admin\Pages\User\Index;
use App\Validations\UserValidation;

class UserController
{
    // hiển thị danh sách
    public static function index()
    {

        $User =  new User();
        $data=$User->getAllUser();

        // echo '<pre>';
        // var_dump($data);
        Header::render();
        Notification::render();
        NotificationHelper::clear();
        // hiển thị giao diện danh sách
        Index::render($data);
        Footer::render();
    }


    // // hiển thị giao diện form thêm
    // public static function create()
    // {
    //     Header::render();
    //     Notification::render();
    //     NotificationHelper::clear();
    //     // hiển thị form thêm
    //     Create::render();
    //     Footer::render();
    // }


    // // xử lý chức năng thêm
    // public static function store()
    // {
    //     //validation các trường dữ liệu
    //     $is_valid=UserValidation::create();

    //     if(!$is_valid){
    //         NotificationHelper::error('store', 'Thêm loại sản phẩm thất bại');
    //         header('location: /admin/users/create');
    //         exit;
    //     }

    //     $name=$_POST['name'];
    //     $status = $_POST['status'];
    //     //kiểm tra tên loại có tồn tại chưa => không được trùng tên
    //     $User= new User();
    //     $is_exist=$User->getOneUserByName($name);

    //     if($is_exist){
    //         NotificationHelper::error('store', 'Tên loại sản phẩm đã tồn tại');
    //         header('location: /admin/users/create');
    //         exit;
    //     }

    //     //thực hiện thêm mới 

    //     $data=[
    //         'name'=> $name,
    //         'status'=> $status
    //     ];

    //     $result= $User->createUser($data);

    //     if($result){
    //         NotificationHelper::success('store', 'Thêm loại sản phẩm thành công');
    //         header('location: /admin/users');

    //     }
    //     else{
    //         NotificationHelper::error('store', 'Thêm loại sản phẩm thất bại');
    //         header('location: /admin/users/create');
    //     }
    // }


    // // hiển thị chi tiết
    // public static function show()
    // {
    // }


    // hiển thị giao diện form sửa
    public static function edit(int $id)
    {
        $User=new User();
        $data=$User->getOneUser($id);

        if(!$data){
            NotificationHelper::error('edit', 'Không thể xem loại sản phẩm này');
            header('location: /admin/users');
            exit;
        }

            Header::render();
            Notification::render();
            NotificationHelper::clear();
            // hiển thị form sửa
            Edit::render($data);
            Footer::render();
    }


    // xử lý chức năng sửa (cập nhật)
    public static function update(int $id)
    {
        //validation các trường dữ liệu
        $is_valid=UserValidation::edit();

        if(!$is_valid){
            NotificationHelper::error('update', 'Cập nhật loại sản phẩm thất bại');
            header("location: /admin/users/$id");
            exit;
        }
        $user= new User();

        //thực hiện cập nhật loại sản phẩm

        $data=[
            'email'=> $_POST['email'],
            'name'=> $_POST['name'],
            'status'=> $_POST['status']
        ];

        if($_POST['password'] !== ''){
            $data['password']=password_hash($_POST['password'], PASSWORD_DEFAULT);
        }
        $is_upload= UserValidation::uploadAvatar();
        if($is_upload){
            $data['avatar'] = $is_upload;
        }

        $result= $user->updateUser($id, $data);

        if($result){
            // echo $name;
            // var_dump($name);
            // var_dump($is_exist['id']);
            // var_dump($id);
            NotificationHelper::success('update', 'Cập nhật loại sản phẩm thành công');
            header('location: /admin/users');

        }
        else{
            NotificationHelper::error('update', 'Cập nhật loại sản phẩm thất bại');
            header("location: /admin/users/$id");
        }

    }


    // // thực hiện xoá
    // public static function delete(int $id)
    // {
    //     $User=new User();
    //     $result=$User->deleteUser($id);

    //     // var_dump($result);
    //     if($result){
    //         NotificationHelper::success('delete', 'Xóa loại sản phẩm thành công');

    //     }
    //     else{
    //         NotificationHelper::error('delete', 'Xóa loại sản phẩm thất bại');
    //     }
    //     header('location: /admin/users');
    // }
}
