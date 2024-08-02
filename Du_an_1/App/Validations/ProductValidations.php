<?php

namespace App\Validations;

use App\Helpers\NotificationHelper;

class ProductValidations {

    public static function create():bool {

        $is_valid = true;

        //Tên validation
        if (!isset($_POST['name']) || $_POST['name'] === '') {
            NotificationHelper::error('name', 'Không để trống tên loại sản phẩm!');
            $is_valid = false;
        }

        //Giá tiền validation
        if (!isset($_POST['price']) || $_POST['price'] === '') {
            NotificationHelper::error('price', 'Không để trống giá sản phẩm!');
            $is_valid = false;
        }elseif((int)$_POST['price'] <= 0){
                NotificationHelper::error('price','Giá sản phẩm phải lớn hơn 0!');
                $is_valid = false;
            
        }

        //Giá giảm validation
        if (!isset($_POST['discount_price']) || $_POST['discount_price'] === '') {
            NotificationHelper::error('discount_price', 'Không để trống giá giảm sản phẩm!');
            $is_valid = false;
        }elseif((int)$_POST['discount_price'] < 0){
                NotificationHelper::error('discount_price','Giá giảm sản phẩm không được bé hơn 0!');
                $is_valid = false;
            
        }elseif((int)$_POST['discount_price'] > (int)$_POST['price']){
            NotificationHelper::error('discount_price','Giá giảm sản phẩm phải nhỏ hơn giá sản phẩm!');
            $is_valid = false;
        }

        //ID loại sp validation
        if (!isset($_POST['category_id']) || $_POST['category_id'] === '') {
            NotificationHelper::error('category_id', 'Không để trống loại sản phẩm!');
            $is_valid = false;
        }


        //Is_feature validation
        if (!isset($_POST['is_feature']) || $_POST['is_feature'] === '') {
            NotificationHelper::error('is_feature', 'Không để trống nổi bật!');
            $is_valid = false;
        }


        //Status validation
        if (!isset($_POST['status']) || $_POST['status'] === '') {
            NotificationHelper::error('status', 'Không để trống trạng thái!');
            $is_valid = false;
        }
        return $is_valid;
    }



    public static function uploadImage() {
        // Check if file has been uploaded
        if (!file_exists($_FILES['image']['tmp_name']) || !is_uploaded_file($_FILES['image']['tmp_name'])) {
            // NotificationHelper::error('avatar', 'Vui lòng chọn ảnh đại diện!');
            return false;
        }
    
        // Directory to store uploaded images
        $target_dir = 'public/uploads/products/';
    
        // Check file type
        $imageFileType = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        if ($imageFileType != 'jpg' && $imageFileType != 'jpeg' && $imageFileType != 'png' && $imageFileType != 'gif') {
            NotificationHelper::error('type_upload', 'Chỉ cho phép upload file ảnh JPG, JPEG, PNG, GIF!');
            return false;
        }
    
        // Generate a new name for the image file based on date and extension
        $nameImage = date('YmdHis') . '.' . $imageFileType;
    
        // Full path to move the uploaded file to
        $target_file = $target_dir . $nameImage;
    
        // Move the uploaded file to the destination directory
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            NotificationHelper::error('move_upload', 'Không thể tải ảnh vào thư mục đã lưu trữ!');
            return false;
        }
    
        // Return the filename if upload is successful
        return $nameImage;
    }



    // public static function edit():bool {

    //     $is_valid = true;

    //     //Tên loại validation
    //     if (!isset($_POST['name']) || $_POST['name'] === '') {
    //         NotificationHelper::error('name', 'Không để trống tên loại sản phẩm!');
    //         $is_valid = false;
    //     }

    //     //Status validation
    //     if (!isset($_POST['status']) || $_POST['status'] === '') {
    //         NotificationHelper::error('status', 'Không để trống trạng thái!');
    //         $is_valid = false;
    //     }
    //     return $is_valid;
    // }
}