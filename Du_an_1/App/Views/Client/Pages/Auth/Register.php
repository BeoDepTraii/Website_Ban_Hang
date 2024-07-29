<?php

namespace App\Views\Client\Pages\Auth;

use App\Views\BaseView;

class Register extends BaseView{
    public static function render($data = null)
    {
    ?>

        <!-- Code html hiển thị giao diện -->
        <div style="height: 100px;"></div>
         <div class="container mt-5">
            <div class="row">
                <div class="offset-md-3 col-md-6">
                    <div class="card card-body">
                        <h4 class="text-center text-danger">Đăng Ký</h4>
                        <form action="/register" method="post">
                            <input type="hidden" name="method" value="POST">
                            <div class="form-group">
                              <label for="name">* Họ tên</label>
                              <input type="text" name="name" id="name" class="form-control" placeholder="Nhập họ và tên" >
                            </div>

                            <div class="form-group">
                              <label for="username">* Tên đăng nhập</label>
                              <input type="text" name="username" id="username" class="form-control" placeholder="Nhập tên đăng nhập" >
                            </div>

                            <div class="form-group">
                              <label for="password">* Mật khẩu</label>
                              <input type="password" name="password" id="password" class="form-control" placeholder="Nhập mật khẩu" >
                            </div>

                            <div class="form-group">
                              <label for="confirmPassword">* Nhập lại mật khẩu</label>
                              <input type="password" name="confirmPassword" id="confirmPassword" class="form-control" placeholder="Nhập lại mật khẩu" >
                            </div>

                            <div class="form-group">
                              <label for="email">* Email</label>
                              <input type="email" name="email" id="email" class="form-control" placeholder="Nhập email" >
                            </div>
                            <button type="reset" class="btn btn-outline-danger">Nhập lại</button>
                            <button type="submit" class="btn btn-outline-info">Đăng ký</button>
                        </form>
                    </div>
                </div>
            </div>
         </div>

    <?php
    }

}