<?php

namespace App\Controllers\Client;

use App\Models\Contact;
use App\Helpers\NotificationHelper;
use App\Views\Client\Components\Notification;
use App\Views\Client\Layouts\Footer;
use App\Views\Client\Layouts\Header;
use App\Views\Client\Pages\Contact\Index;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class ContactController
{
    // hiển thị trang home
    public static function index()
    {
        Header::render();
        Notification::render();  // hiển thị thông báo
        NotificationHelper::clear(); //clear notification
        Index::render();
        Footer::render();
    }

    public static function send()
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $message = $_POST['message'];

        $contact = new Contact();
        $data=[
            'username' => $name,
            'email' => $email,
            'contact' => $message,
        ];
        $result = $contact->createContact($data);

 if($result){
    NotificationHelper::success('store', 'thành công!');
    header('Location: /contact');
    exit;
}else{
    NotificationHelper::error('store', 'thất bại!');
    header('Location: /contact');
    exit;
}


        // Kiểm tra dữ liệu POST
        if (empty($name) || empty($email) || empty($message)) {
            NotificationHelper::error('form', 'Tất cả các trường là bắt buộc.');
            header('Location: /contact');
            exit();
        }

        // Cấu hình PHPMailer
        $mail = new PHPMailer(true);

        try {
            // Cấu hình server
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';  // Địa chỉ SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'cuongdxpc07945@fpt.edu.vn';  // Tài khoản email
            $mail->Password = 'szfcgofroznptdph';  // Mật khẩu email
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // SSL
            $mail->Port = 465;  // Cổng SMTP
            
            
            // Người gửi và người nhận
            $mail->setFrom('cuongdxpc07945@fpt.edu.vn', 'Xuan Cuong');
            $mail->addAddress('cuongdxpc07945@fpt.edu.vn', 'Xuan Cuong');

            // Nội dung email
            $mail->isHTML(true);
            $mail->Subject = 'New users contact you';
            $mail->Body    = "<h1>Gửi biểu mẫu liên hệ</h1>
                               <p><strong>Tên:</strong> $name</p>
                               <p><strong>Email:</strong> $email</p>
                               <p><strong>Nội dung thư:</strong> $message</p>";
            $mail->send();
            NotificationHelper::success('form', 'Tin nhắn của bạn đã được gửi thành công.');
        } catch (Exception $e) {
            NotificationHelper::error('form', 'Không thể gửi tin nhắn. Lỗi gửi thư: ' . $mail->ErrorInfo);
        }

        // Redirect về trang contact
        header('Location: /contact');
        exit();
    }
}