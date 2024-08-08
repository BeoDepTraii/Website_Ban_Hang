<?php
    namespace App\Validations;

use App\Helpers\NotificationHelper;

    class CommentValidation{
        public static function create():bool{
            $is_valid = true;

        return $is_valid;
        }
        public static function edit():bool{
            $is_valid = true;
        //Validate trạng thái
        if(!isset($_POST['status']) || $_POST['status'] ===''){
            NotificationHelper::error('status', 'Không để trống !');
            $is_valid = false;
        }

        return $is_valid;
        }
    }

?>