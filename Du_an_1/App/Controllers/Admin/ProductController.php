<?php

namespace App\Controllers\Admin;

use App\Helpers\NotificationHelper;
use App\Models\Category;
use App\Models\Product;
use App\Views\Admin\Layouts\Footer;
use App\Views\Admin\Layouts\Header;
use App\Views\Admin\Components\Notification;
use App\Views\Admin\Pages\Product\Create;
use App\Views\Admin\Pages\Product\Edit;
use App\Views\Admin\Pages\Product\Index;
use App\Validations\ProductValidation;

class ProductController
{
    // hiển thị danh sách
    public static function index()
    {
        $product =  new Product();
        $data=$product->getAllProductJoinCategory();

        // var_dump($data);
        Header::render();
        Notification::render();
        NotificationHelper::clear();
        // hiển thị giao diện danh sách
        Index::render($data);
        Footer::render();
    }


    // hiển thị giao diện form thêm
    public static function create()
    {

        $category = new Category;
        $data= $category->getAllCategory(); 
        // echo '<pre>';
        // var_dump($data);
        Header::render();
        Notification::render();
        NotificationHelper::clear();
        // hiển thị form thêm
        Create::render($data);
        Footer::render();
    }


    // xử lý chức năng thêm
    public static function store()
    {
        //validation các trường dữ liệu
        $is_valid=ProductValidation::create();

        // var_dump($is_valid);

        if(!$is_valid){
            NotificationHelper::error('store', 'Thêm sản phẩm thất bại');
            header('location: /admin/products/create');
            exit;
        }

        $name=$_POST['name'];
        $status = $_POST['status'];
        //kiểm tra tên sản ph có tồn tại chưa => không được trùng tên
        $product= new Product();
        $is_exist=$product->getOneProductByName($name);

        if($is_exist){
            NotificationHelper::error('store', 'Tên sản phẩm đã tồn tại');
            header('location: /admin/products/create');
            exit;
        }

        //thực hiện thêm mới 

        $data=[
            'name'=> $name,
            'status'=> $status
        ];

        $result= $product->createProduct($data);

        if($result){
            NotificationHelper::success('store', 'Thêm sản phẩm thành công');
            header('location: /admin/products');

        }
        else{
            NotificationHelper::error('store', 'Thêm sản phẩm thất bại');
            header('location: /admin/products/create');
        }
    }


    // // hiển thị chi tiết
    // public static function show()
    // {
    // }


    // // hiển thị giao diện form sửa
    // public static function edit(int $id)
    // {
    //     // giả sử data là mảng dữ liệu lấy được từ database
    //     // $data = [
    //     //     'id' => $id,
    //     //     'name' => 'Product 1',
    //     //     'status' => 1
    //     // ];

    //     $Product=new Product();
    //     $data=$Product->getOneProduct($id);

    //     if(!$data){
    //         NotificationHelper::error('edit', 'Không thể xem loại sản phẩm này');
    //         header('location: /admin/categories');
    //         exit;
    //     }

    //         Header::render();
    //         Notification::render();
    //         NotificationHelper::clear();
    //         // hiển thị form sửa
    //         Edit::render($data);
    //         Footer::render();
    //     // if ($data) {
    //     //     Header::render();
    //     //     // hiển thị form sửa
    //     //     Edit::render($data);
    //     //     Footer::render();
    //     // } else {
    //     //     header('location: /admin/categories');
    //     // }
    // }


    // // xử lý chức năng sửa (cập nhật)
    // public static function update(int $id)
    // {
    //     //validation các trường dữ liệu
    //     $is_valid=ProductValidation::edit();

    //     if(!$is_valid){
    //         NotificationHelper::error('update', 'Cập nhật loại sản phẩm thất bại');
    //         header("location: /admin/categories/$id");
    //         exit;
    //     }

    //     $name=$_POST['name'];
    //     $status = $_POST['status'];
    //     //kiểm tra tên loại có tồn tại chưa => không được trùng tên
    //     $Product= new Product();
    //     $is_exist=$Product->getOneProductByName($name);


    //     if($is_exist){
    //         if($is_exist['id'] !=$id ){
    //             NotificationHelper::error('update', 'Tên loại sản phẩm đã tồn tại');
    //             header("location: /admin/categories/$id");
    //             exit;
    //         }
    //     }

    //     //thực hiện cập nhật loại sản phẩm

    //     $data=[
    //         'name'=> $name,
    //         'status'=> $status
    //     ];

    //     $result= $Product->updateProduct($id, $data);

    //     if($result){
    //         // echo $name;
    //         // var_dump($name);
    //         // var_dump($is_exist['id']);
    //         // var_dump($id);
    //         NotificationHelper::success('update', 'Cập nhật loại sản phẩm thành công');
    //         header('location: /admin/categories');

    //     }
    //     else{
    //         NotificationHelper::error('update', 'Cập nhật loại sản phẩm thất bại');
    //         header("location: /admin/categories/$id");
    //     }

    // }


    // // thực hiện xoá
    // public static function delete(int $id)
    // {
    //     $Product=new Product();
    //     $result=$Product->deleteProduct($id);

    //     // var_dump($result);
    //     if($result){
    //         NotificationHelper::success('delete', 'Xóa loại sản phẩm thành công');

    //     }
    //     else{
    //         NotificationHelper::error('delete', 'Xóa loại sản phẩm thất bại');
    //     }
    //     header('location: /admin/categories');
    // }
}
