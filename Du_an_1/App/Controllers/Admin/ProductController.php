<?php

namespace App\Controllers\Admin;

use App\Helpers\NotificationHelper;
use App\Models\Category;
use App\Models\Product;
use App\Validations\ProductValidations;
use App\Views\Admin\Layouts\Footer;
use App\Views\Admin\Layouts\Header;
use App\Views\Admin\Components\Notification;
use App\Views\Admin\Pages\Product\Create;
use App\Views\Admin\Pages\Product\Edit;
use App\Views\Admin\Pages\Product\Index;

class ProductController
{


    // hiển thị danh sách
    public static function index()
    {

        $product = new Product();
        $data = $product->getAllProductJoinCategory();

        Header::render();
        Notification::render();  // hiển thị thông báo
        NotificationHelper::clear(); //clear notification
        // hiển thị giao diện danh sách
        Index::render($data);
        Footer::render();
    }


    // hiển thị giao diện form thêm
    public static function create()
    {
        $category = new Category();
        $data = $category->getAllCategory();

        Header::render();
        Notification::render();  // hiển thị thông báo
        NotificationHelper::clear(); //clear notification
        // hiển thị form thêm
        Create::render($data);
        Footer::render();
    }


    // xử lý chức năng thêm
    public static function store()
    {
        //Validate
        $is_valid = ProductValidations::create();

        if(!$is_valid){
            NotificationHelper::error('store', 'Thêm mới sản phẩm thất bại!');
            header('Location: /admin/products/create');
            exit;
        }
        $name = $_POST['name'];
        //Check tồn tại tên sp (ko trùng)
        $product = new Product();
        $is_exist = $product->getOneProductByName($name);
        if ($is_exist) {
            NotificationHelper::error('store', 'Tên sản phẩm đã tồn tại!');
            header('Location: /admin/products/create');
            exit;
        }

        //Thêm vào CSDL
        $data=[
            'name' => $name,
            'price' => $_POST['price'],
            'discount_price' => $_POST['discount_price'],
            'description' => $_POST['description'],
            'is_feature' => $_POST['is_feature'],
            'category_id' => $_POST['category_id'],
            'status' => $_POST['status'],
        ];

        $is_upload=ProductValidations::uploadImage();
        if($is_upload){
            $data['image'] = $is_upload;
        }
        $result = $product->createProduct($data);

        if($result){
            NotificationHelper::success('store', 'Thêm mới sản phẩm thành công!');
            header('Location: /admin/products');
            exit;
        }else{
            NotificationHelper::error('store', 'Thêm mới sản phẩm thất bại!');
            header('Location: /admin/products/create');
            exit;
        }
    }


    // hiển thị chi tiết
    public static function show()
    {
    }


    // hiển thị giao diện form sửa
    public static function edit(int $id)
    {
        // // giả sử data là mảng dữ liệu lấy được từ database
        // $data = [
        //     'id' => $id,
        //     'name' => 'Product 1',
        //     'status' => 1
        // ];
        $product = new Product();
        $data = $product->getOneProduct($id);

        $category = new Category();
        $dataCate = $category->getAllCategory();

        if (!$data) {
            NotificationHelper::error('edit', 'Sản phẩm không tồn tại!');
            header('location: /admin/products');
            exit;

        }
        Header::render();
        Notification::render();  // hiển thị thông báo
        NotificationHelper::clear(); //clear notification
        // hiển thị form sửa
        Edit::render($data, $dataCate);
        Footer::render();
    }


//     // xử lý chức năng sửa (cập nhật)
public static function update(int $id)
    {
        //Validate
        $is_valid = ProductValidations::edit();

        if(!$is_valid){
            NotificationHelper::error('update', 'Cập nhật sản phẩm thất bại!');
            header("Location: /admin/products/$id");
            exit;
        }
        $name = $_POST['name'];
        //Check tồn tại tên loại (ko trùng)
        $product = new Product();
        $is_exist = $product->getOneProductByName($name);
        if ($is_exist) {
                if($is_exist['id']!= $id){
                    NotificationHelper::error('update', 'Tên loại sản phẩm đã tồn tại!');
                    header("Location: /admin/products/$id");
                    exit;
                }

        }

        //Thêm vào CSDL
        $data=[
            'name' => $name,
            'price' => $_POST['price'],
            'discount_price' => $_POST['discount_price'],
            'description' => $_POST['description'],
            'is_feature' => $_POST['is_feature'],
            'category_id' => $_POST['category_id'],
            'status' => $_POST['status'],
        ];

        $is_upload=ProductValidations::uploadImage();
        if($is_upload){
            $data['image'] = $is_upload;
        }

        $result = $product->updateProduct($id,$data);

        if($result){
            NotificationHelper::success('update', 'Cập nhật loại sản phẩm thành công!');
            header('Location: /admin/products');
            exit;
        }else{
            NotificationHelper::error('update', 'Cập nhật loại sản phẩm thất bại!');
            header("Location: /admin/products/$id");
            exit;
        }

    }


    // thực hiện xoá
    public static function delete(int $id)
    {
        $product = new Product();
        $result = $product->deleteProduct($id);

        if($result){
            NotificationHelper::success('delete', 'Xóa loại sản phẩm thành công!');

        }else{
            NotificationHelper::error('delete', 'Xóa loại sản phẩm thất bại!');

        }
        header('Location: /admin/products');
        
    }
}
