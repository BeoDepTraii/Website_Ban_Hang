<?php

namespace App\Views\Admin\Pages\Product;

use App\Views\BaseView;

class Edit extends BaseView
{
    public static function render($data = null, $dataCate = null)
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
                        <h4 class="page-title">QUẢN LÝ SẢN PHẨM</h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/admin">Trang chủ</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Sửa sản phẩm</li>
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
                            <form class="form-horizontal" action="/admin/products/<?= $data['id'] ?>" method="POST" enctype="multipart/form-data">
                                <div class="card-body">
                                    <h4 class="card-title">Sửa sản phẩm</h4>
                                    <input type="hidden" name="method" id="" value="PUT">

                                    <div align="center">
                                        <img src="<?=APP_URL?>/public/uploads/products/<?=$data['image']?>" alt="" width="300px">
                                    </div>
                                    <div class="form-group">
                                        <label for="id">ID</label>
                                        <input type="text" class="form-control" id="id"  name="id" value="<?= $data['id'] ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Tên*</label>
                                        <input type="text" class="form-control" id="name" placeholder="Nhập tên sản phẩm..." name="name" value="<?= $data['name'] ?>" >
                                    </div>
                                    <div class="form-group">
                                        <label for="price">Giá tiền*</label>
                                        <input type="number" class="form-control" id="price" placeholder="Nhập giá sản phẩm..." name="price" value="<?= $data['price'] ?>" >
                                    </div>
                                    <div class="form-group">
                                        <label for="discount_price">Giá giảm*</label>
                                        <input type="number" class="form-control" id="discount_price" placeholder="Nhập giá giảm sản phẩm..." name="discount_price" value="<?= $data['discount_price'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Mô tả</label>
                                        <textarea class="form-control" id="description" placeholder="Nhập mô tả sản phẩm..." name="description" ><?= $data['description'] ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="category_id">Loại sản phẩm*</label>
                                        <select class="select2 form-select shadow-none" style="width: 100%; height:36px;" id="category_id" name="category_id" >
                                        <option value="" selected disabled>Vui lòng chọn...</option> 
                                            <?php
                                            foreach ($dataCate as $item) :
                                            ?>
                                            <option value="<?= $item['id']?>" <?= ($item['id'] == $data['id'])? 'selected' : '' ?>><?= $item['name']?></option>
                                            <?php
                                            endforeach;
                                            ?>

                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="image">Hình ảnh</label>
                                        <input type="file" class="form-control" id="image" placeholder="Chọn hình ảnh sản phẩm..." name="image" >
                                    </div>
                                    <div class="form-group">
                                        <label for="is_feature">Nổi bật*</label>
                                        <select class="select2 form-select shadow-none" style="width: 100%; height:36px;" id="is_feature" name="is_feature" >
                                            <option value="" selected disabled>Vui lòng chọn...</option>
                                            <option value="1">Nổi bật</option>
                                            <option value="0">Không</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Trạng thái*</label>
                                        <select class="select2 form-select shadow-none" style="width: 100%; height:36px;" id="status" name="status" >
                                            <option value="" selected disabled>Vui lòng chọn...</option>
                                            <option value="1">Hiển thị</option>
                                            <option value="0">Ẩn</option>
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
