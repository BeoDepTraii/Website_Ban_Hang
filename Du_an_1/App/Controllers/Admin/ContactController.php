<?php

namespace App\Controllers\Admin;

use App\Helpers\NotificationHelper;
use App\Models\Contact;
use App\Views\Admin\Layouts\Footer;
use App\Views\Admin\Layouts\Header;
use App\Views\Admin\Components\Notification;
use App\Views\Admin\Pages\Contact\Index;

class ContactController
{


    // hiển thị danh sách
    public static function index()
    {

        $contact = new Contact();
        $data = $contact->getAllContact();

        Header::render();
        Notification::render();  // hiển thị thông báo
        NotificationHelper::clear(); //clear notification
        // hiển thị giao diện danh sách
        Index::render($data);
        Footer::render();
    }

    // thực hiện xoá
    public static function delete(int $id)
    {
        $contact = new Contact();
        $result = $contact->deleteContact($id);

        if($result){
            NotificationHelper::success('delete', 'Xóa sản phẩm thành công!');

        }else{
            NotificationHelper::error('delete', 'Xóa sản phẩm thất bại!');

        }
        header('Location: /admin/contacts');
        
    }
}
