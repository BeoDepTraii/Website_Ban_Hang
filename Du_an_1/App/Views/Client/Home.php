<?php

namespace App\Views\Client;

use App\Views\BaseView;

class Home extends BaseView
{
    public static function render($data = null)
    {
?>
        <!-- Hero Start -->
        <div class="container-fluid py-5 mb-5 hero-header">
            <div class="container py-5">
                <div class="row g-5 align-items-center">
                    <div class="col-md-12 col-lg-7">
                        <h4 class="mb-3 text-secondary">100% Thực Phẩm Sạch</h4>
                        <h1 class="mb-5 display-3 text-primary">Trái cây tươi & Rau củ sạch</h1>
                        <!-- <div class="position-relative mx-auto">
                            <input class="form-control border-2 border-secondary w-75 py-3 px-4 rounded-pill" type="number" placeholder="Search">
                            <button type="submit" class="btn btn-primary border-2 border-secondary py-3 px-4 position-absolute rounded-pill text-white h-100" style="top: 0; right: 25%;">Tìm kiếm</button>
                        </div> -->
                    </div>
                    <div class="col-md-12 col-lg-5">
                        <div id="carouselId" class="carousel slide position-relative" data-bs-ride="carousel">
                            <div class="carousel-inner" role="listbox">
                                <div class="carousel-item active rounded">
                                    <img src="<?= APP_URL ?>/public/assets/client/images/hero-img-1.png" class="img-fluid w-100 h-100 bg-secondary rounded" alt="First slide">
                                </div>
                                <div class="carousel-item rounded">
                                    <img src="<?= APP_URL ?>/public/assets/client/images/hero-img-2.jpg" class="img-fluid w-100 h-100 rounded" alt="Second slide">
                                </div>
                            </div>
                            <!-- <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Trước</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Sau</span>
                            </button> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hero End -->


        <!-- Featurs Section Start -->
        <div class="container-fluid featurs py-5">
            <div class="container py-5">
                <div class="row g-4">
                    <div class="col-md-6 col-lg-3">
                        <div class="featurs-item text-center rounded bg-light p-4">
                            <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                                <i class="fas fa-car-side fa-3x text-white"></i>
                            </div>
                            <div class="featurs-content text-center">
                                <h5>Miễn phí giao hàng</h5>
                                <p class="mb-0">Cho hoá đơn trên 200,000 VNĐ</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="featurs-item text-center rounded bg-light p-4">
                            <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                                <i class="fas fa-user-shield fa-3x text-white"></i>
                            </div>
                            <div class="featurs-content text-center">
                                <h5>Thanh toán an toàn</h5>
                                <p class="mb-0">100% Thanh toán an toàn</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="featurs-item text-center rounded bg-light p-4">
                            <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                                <i class="fas fa-exchange-alt fa-3x text-white"></i>
                            </div>
                            <div class="featurs-content text-center">
                                <h5>5 ngày hoàn trả</h5>
                                <p class="mb-0">Hoàn lại trong 5 ngày</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="featurs-item text-center rounded bg-light p-4">
                            <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                                <i class="fa fa-phone-alt fa-3x text-white"></i>
                            </div>
                            <div class="featurs-content text-center">
                                <h5>Hỗ trợ 24/7</h5>
                                <p class="mb-0">Hỗ trợ, tư vấn nhanh</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Featurs Section End -->


        <!-- Fruits Shop Start-->
        <div class="container-fluid fruite py-5">
            <div class="container py-5">
                <div class="tab-class text-center">
                    <div class="row g-4">
                        <div class="col-lg-4 text-start">
                            <h1>Sản phẩm</h1>
                        </div>
                        <div class="col-lg-8 text-end">
                            <ul class="nav nav-pills d-inline-flex text-center mb-5">
                                <li class="nav-item">
                                    <a class="d-flex m-2 py-2 bg-light rounded-pill active" data-bs-toggle="pill" href="#tab-1">
                                        <span class="text-dark" style="width: 130px;">Tất cả</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="d-flex py-2 m-2 bg-light rounded-pill" data-bs-toggle="pill" href="#tab-2">
                                        <span class="text-dark" style="width: 130px;">Rau củ</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="d-flex m-2 py-2 bg-light rounded-pill" data-bs-toggle="pill" href="#tab-3">
                                        <span class="text-dark" style="width: 130px;">Trái cây</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane fade show p-0 active">
                            <div class="row g-4">
                            <div class="col-lg-12">
                                
                                <div class="row g-4 justify-content-center">
                                <?php
                    if (count($data) && count($data['products'])) :
                    ?>
                        <div class="row">
                            <?php
                            foreach ($data['products'] as $item) :
                            ?>
                            <!-- Product -->
                            <div class="col-md-6 col-lg-6 col-xl-4">
                                        <div class="rounded position-relative fruite-item">
                                            <div class="fruite-img">
                                            <img src="<?= APP_URL ?>/public/uploads/products/<?= $item['image'] ?>" class="img-fluid w-100 rounded-top" alt=""  data-holder-rendered="true">
                                            </div>
                                            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">Fruits</div>
                                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                <h4 class="card-text"><?= $item['name'] ?></h4>
                                                
                                                <div class="d-flex justify-content-between flex-lg-wrap">
                                                <?php
                                            if ($item['discount_price'] > 0) :
                                            ?>
                                                <p>Giá gốc: <strike><?= number_format($item['price']) ?> đ</strike></p>
                                                <p>Giá giảm: <strong class="text-danger"><?= number_format($item['price'] - $item['discount_price']) ?> đ</strong></p>

                                            <?php
                                            else :
                                            ?>
                                                <p>Giá tiền: <?= number_format($item['price']) ?> đ</p>

                                            <?php
                                            endif;
                                            ?>

                                                
                                                </div>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="btn-group">
                                                    <a href="/products/<?= $item['id'] ?>" type="button" class="btn btn-sm btn-outline-info rounded-pill">Chi tiết</a>
                                                    <form action="/cart/add" method="post">
                                                        <input type="hidden" name="method" id="" value="POST">
                                                        <input type="hidden" name="id" id="" value="<?= $item['id'] ?>" required>
                                                        <button type="submit" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i>Thêm vào giỏ</button>
                                                    </form>
                                                </div>
                                            </div>

                                            </div>
                                        </div>
                                    </div>
                                     <!-- End product -->
                            <?php
                            endforeach;

                            ?>
                        </div>
                    <?php
                    else :
                    ?>
                        <h3 class="text-center text-danger">Không có sản phẩm</h3>

                    <?php
                    endif;
                    ?>  
                                      
                                    <div class="col-12">
                                        <div class="pagination d-flex justify-content-center mt-5">
                                            <a href="#" class="rounded">&laquo;</a>
                                            <a href="#" class="active rounded">1</a>
                                            <a href="#" class="rounded">2</a>
                                            <a href="#" class="rounded">3</a>
                                            <a href="#" class="rounded">4</a>
                                            <a href="#" class="rounded">5</a>
                                            <a href="#" class="rounded">6</a>
                                            <a href="#" class="rounded">&raquo;</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        
                        

                    </div>
                </div>      
            </div>
        </div>
        <!-- Fruits Shop End-->


       
<?php
    }
}
