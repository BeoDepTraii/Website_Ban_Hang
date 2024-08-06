<?php

namespace App\Views\Admin\Pages\User;

use App\Views\BaseView;

class Edit extends BaseView
{
    public static function render($data = null)
    {
?>

        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">QUẢN LÝ Người Dùng</h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/admin">Trang chủ</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Cập Nhật Người Dùng</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <form class="form-horizontal" action="/admin/users/<?= $data['id'] ?>" method="POST" enctype="multipart/form-data">
                                <div class="card-body">
                                    <h4 class="card-title">Cập Nhật Người Dùng</h4>
                                    <input type="hidden" name="method" id="" value="PUT">
                                    <div class="form-group">
                                        <label for="id">ID</label>
                                        <input type="text" class="form-control" id="id"  name="id" value="<?= $data['id'] ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="username">Tên Đăng Nhập*</label>
                                        <input type="text" class="form-control" id="username" placeholder="Nhập tên đăng nhập người dùng..." name="username" value="<?= $data['username'] ?>" >

                                    </div>
                                    <div class="form-group">
                                        <label for="name">Tên*</label>
                                        <input type="text" class="form-control" id="name" placeholder="Nhập tên người dùng..." name="name" value="<?= $data['name'] ?>" >

                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email*</label>
                                        <input type="text" class="form-control" id="email" placeholder="Nhập email..." name="email" value="<?= $data['email'] ?>" >

                                    </div>
                                    <div class="form-group">
                                        <label for="password">Mật Khẩu*</label>
                                        <input type="password" class="form-control" id="password" placeholder="Nhập mật khẩu..." name="password" " >
                                    </div>
                                    <div class="form-group">
                                        <label for="re_password"> Nhập Lại Mật Khẩu*</label>
                                        <input type="password" class="form-control" id="re_password" placeholder="Nhập lại mật khẩu..." name="re_password" " >
                                    </div>
                                    <div class="form-group">
                                        <label for="avatar"> Nhập Lại Mật Khẩu*</label>
                                        <input type="file" class="form-control" id="avatar" placeholder="Chỉnh sửa hình ảnh..." name="avatar" " >
                                    </div>
                                    <div class="form-group">
                                        <label for="role"> Role*</label>
                                        <input type="text" class="form-control" id="role" name="role" value="<?= ($data['role']==1)? 'Admin' : 'User'?>" disabled >                                   
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Trạng thái*</label>
                                        <select class="select2 form-select shadow-none" style="width: 100%; height:36px;" id="status" name="status" >
                                            <option value="" selected disabled>Vui lòng chọn...</option>
                                            <option value="1" <?= ($data['status'] == 1 ? 'selected' : '') ?>>Hiển thị</option>
                                            <option value="0" <?= ($data['status'] == 0 ? 'selected' : '') ?>>Ẩn</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="border-top">
                                    <div class="card-body">
                                        <button type="reset" class="btn btn-danger text-white" name="">Làm lại</button>
                                        <button type="submit" class="btn btn-primary" name="">Cập nhật</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>

                </div>

                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->

    <?php
    }
}
