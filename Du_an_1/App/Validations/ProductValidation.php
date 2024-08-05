<?php
    namespace App\Validations;

use App\Helpers\NotificationHelper;

    class ProductValidation{
        public static function create():bool{
            $is_valid = true;
        //Validate tên sản phẩm
        if(!isset($_POST['name']) || $_POST['name'] ===''){
            NotificationHelper::error('name', 'Không để trống tên loại sản phẩm!');
            $is_valid = false;
        }
         //Validate giá tiền
         if(!isset($_POST['price']) || $_POST['price'] ===''){
            NotificationHelper::error('price', 'Không để trống giá tiền!');
            $is_valid = false;
        }
        elseif((int) $_POST['price']<=0){
            NotificationHelper::error('price', 'Giá tiền phải lớn hơn 0');
            $is_valid = false;
        }
         //Validate giá tiền
         if(!isset($_POST['discount_price']) || $_POST['discount_price'] ===''){
            NotificationHelper::error('discount_price', 'Không để trống giá giảm!');
            $is_valid = false;
        }
        elseif((int) $_POST['discount_price']<0){
            NotificationHelper::error('discount_price', 'Giá giảm phải lớn hơn hoặc bằng 0');
            $is_valid = false;
        }
        elseif((int) $_POST['discount_price'] < (int) $_POST['price'] ){
            NotificationHelper::error('discount_price', 'Giá giảm phải nhỏ hơn giá tiền');
            $is_valid = false;
        }

        //Validate id loại sản phẩm
        if(!isset($_POST['category_id']) || $_POST['category_id'] ===''){
            NotificationHelper::error('category_id', 'Không để trống loại sản phẩm !');
            $is_valid = false;
        }
        //Validate nổi bật
        if(!isset($_POST['is_featured']) || $_POST['is_featured'] ===''){
            NotificationHelper::error('is_featured', 'Vui lòng chọn nổi bật hay không !');
            $is_valid = false;
        }
        //Validate trạng thái
        if(!isset($_POST['status']) || $_POST['status'] ===''){
            NotificationHelper::error('status', 'Hãy chọn trạng thái cho sản phẩm !');
            $is_valid = false;
        }

        return $is_valid;
        }
        public static function edit():bool{
            $is_valid = true;

        return $is_valid;
        }
    }

?>