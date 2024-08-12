<?php

namespace App\Views\Client\Pages\Contact;

use App\Views\BaseView;

class Index extends BaseView
{
    public static function render($data = null)
    {
?>

<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
            <h1 class="text-center text-white display-6">Liên hệ</h1>
            <ol class="breadcrumb justify-content-center mb-0" style="background-color: transparent;">
                <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                <li class="breadcrumb-item active text-white">Liên hệ</li>
            </ol>
        </div>
        <!-- Single Page Header End -->


        <!-- Contact Start -->
        <div class="container-fluid contact py-5">
            <div class="container py-5">
                <div class="p-5 bg-light rounded">
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="text-center mx-auto" style="max-width: 700px;">
                                <h1 class="text-primary">Kết nối với chúng tôi</h1>
                                <p class="mb-4">Điền thông tin trong form bên dưới để chúng tôi liên hệ với bạn!</p>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="h-100 rounded">
                                <iframe class="rounded w-100" 
                                style="height: 400px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3603.293003820271!2d105.75558925338848!3d9.982228404443031!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31a08906415c355f%3A0x416815a99ebd841e!2zVHLGsOG7nW5nIENhbyDEkeG6s25nIEZQVCBQb2x5dGVjaG5pYw!5e0!3m2!1svi!2s!4v1723400196557!5m2!1svi!2s" 
                                loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                            
                        </div>
                        <div class="col-lg-7">
                        <form action="/contact/send" method="POST" class="">
                        <input type="hidden" name="method" id="" value="POST">
                            <input type="text" id="name" name="name" class="w-100 form-control border-0 py-3 mb-4" placeholder="Tên liên hệ" required>
                            <input type="email" id="email" name="email" class="w-100 form-control border-0 py-3 mb-4" placeholder="Email liên hệ" required>
                            <textarea name="message" id="message" class="w-100 form-control border-0 mb-4" rows="5" cols="10" placeholder="Lời nhắn" required></textarea>
                            <button class="w-100 btn form-control border-secondary bg-white text-primary" type="submit" style="font-size: larger; font-weight: bolder;"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                        </form>

                        </div>
                        <div class="col-lg-5">
                            <div class="d-flex p-4 rounded mb-4 bg-white">
                                <i class="fas fa-map-marker-alt fa-2x text-primary me-4"></i>
                                <div>
                                    <h4>Địa chỉ</h4>
                                    <p class="mb-2">FPT Poly Cần Thơ</p>
                                </div>
                            </div>
                            <div class="d-flex p-4 rounded mb-4 bg-white">
                                <i class="fas fa-envelope fa-2x text-primary me-4"></i>
                                <div>
                                    <h4>Email</h4>
                                    <p class="mb-2">lamnhat509@gmail.com</p>
                                </div>
                            </div>
                            <div class="d-flex p-4 rounded bg-white">
                                <i class="fa fa-phone fa-2x text-primary me-4"></i>
                                <div>
                                    <h4>Số điện thoại</h4>
                                    <p class="mb-2">0913 634 651</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact End -->

        <?php
    }
}