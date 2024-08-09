<?php

namespace App\Views\Client\Pages\Product;

use App\Helpers\AuthHelper;
use App\Views\BaseView;

class Detail extends BaseView
{
    public static function render($data = null)
    {
        $is_login = AuthHelper::checkLogin();
        // var_dump($_SESSION);
?>

        <!-- Single Page Header start -->
        <div class="container-fluid page-header py-5">
            <h1 class="text-center text-white display-6">Shop Detail</h1>
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item active text-white">Shop Detail</li>
            </ol>
        </div>
        <!-- Single Page Header End -->

        <div class="container mt-5 mb-5">

            <div class="row">
                <div class="col-md-6">
                    <img src="<?= APP_URL ?>/public/uploads/products/<?= $data['product']['image'] ?>" alt="" width="100%">
                </div>
                <div class="col-md-6">
                    <h5><?= $data['product']['name'] ?></h5>
                    <p>
                        <?= $data['product']['description'] ?>
                    </p>
                    <?php
                    if ($data['product']['discount_price'] > 0) :
                    ?>
                        <h6>Giá gốc: <strike><?= number_format($data['product']['price']) ?> đ</strike></h6>
                        <h6>Giá giảm: <strong class="text-danger"><?= number_format($data['product']['price'] - $data['product']['discount_price']) ?> đ</strong></h6>

                    <?php
                    else :
                    ?>
                        <h6>Giá tiền: <?= number_format($data['product']['price']) ?> đ</h6>
                    <?php
                    endif;
                    ?>
                    <h6>Số Lượt Xem: <?= $data ['product']['view']?> </h6>
                    <h5>Danh mục: <?= $data ['product']['category_name']?></h5>

                    <form action="#" method="post">
                        <input type="hidden" name="method" id="" value="POST">
                        <input type="hidden" name="id" id="" value="<?= $data['product']['id'] ?>" required>
                        <button type="submit" class="btn btn-sm btn-outline-success">Thêm vào giỏ hàng</button>
                    </form>
                </div>
            </div>

            <div class="row d-flex justify-content-center mt-100 mb-100">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body text-center">
                            <h4 class="card-title">Bình luận mới nhất</h4>
                        </div>
                        <div class="comment-widgets">
                            <?php
                            if(isset($data) && isset($data['comments']) && $data && $data['comments']):

                            foreach($data['comments'] as $item):    
                            ?>

                            <!-- Comment Row -->
                            <div class="d-flex flex-row comment-row m-t-0">
                                <div class="p-2">
                                <?php
                                    if($item['avatar']):
                                ?>
                                    <img src="<?= APP_URL ?>/public/uploads/users/<?= $item['avatar']?>" alt="user" width="50" class="rounded-circle">
                                </div>
                                <?php
                                    else:
                                ?>
                                <img src="<?= APP_URL ?>/public/uploads/users/default-user.png" alt="user" width="50" class="rounded-circle">
                                <?php
                                endif;
                                ?>

                                <div class="comment-text w-100">
                                    <h6 class="font-medium"><?=$item['name']?></h6>
                                    <span class="m-b-15 d-block"><?=$item['content']?></span>
                                    <div class="comment-footer">
                                        <span class="text-muted float-right"><?=$item['date']?></span>

                                        <?php
                                        if(isset($data) && $is_login && ($_SESSION['user']['id'] == $item['user_id'])):
                                        ?>

                                        <button type="button" class="btn btn-cyan btn-sm" data-toggle="collapse" data-target="# <?=$item['username']?><?=$item['id']?>" aria-expanded="false" aria-controls="comment">Sửa</button>
                                        <form action="#" method="post" onsubmit="return confirm('Chắc chưa?')" style="display: inline-block">
                                            <input type="hidden" name="method" value="DELETE" id="">
                                            <input type="hidden" name="product_id" value="" id="">
                                            <button type="submit" class="btn btn-danger btn-sm">Xoá</button>

                                        </form>
                                        <div class="collapse" id="<?=$item['username']?><?=$item['id']?>">
                                            <div class="card card-body mt-5">
                                                <form action="#" method="post">
                                                    <input type="hidden" name="method" value="PUT" id="">
                                                    <input type="hidden" name="product_id" value="" id="">
                                                    <div class="form-group">
                                                        <label for="">Bình luận</label>
                                                        <textarea class="form-control rounded-0" name="content" id="" rows="3" placeholder="Nhập bình luận..."><?=$item['content']?></textarea>
                                                    </div>
                                                    <div class="comment-footer">
                                                        <button type="submit" class="btn btn-cyan btn-sm">Gửi</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                        <?php
                                        endif;
                                        ?>
                                    </div>
                                </div>
                            </div>
                            </div>
                            
      
                            <?php
                            endforeach;
                            else:
                            ?>
                            <h6 class="text-center text-danger">Chưa Có Bình Luận</h6>
                            <?php
                            endif;
                            ?>

                            <?php
                            if(isset($data) && $is_login):
                            ?>

                            <div class="d-flex flex-row comment-row">

                                <div class="p-2">

                                    <img src="<?= APP_URL ?>/public/uploads/users/user1.jpeg" alt="user" width="50" class="rounded-circle">
                                </div>
                                <div class="comment-text w-100">
                                    <h6 class="font-medium">Username</h6>
                                    <form action="#" method="post">
                                        <input type="hidden" name="method" value="POST" id="" required>
                                        <div class="form-group">
                                            <label for="">Bình luận</label>
                                            <textarea class="form-control rounded-0" name="content" id="" rows="3" placeholder="Nhập bình luận..." ></textarea>
                                        </div>
                                        <div class="comment-footer">
                                            <button type="submit" class="btn btn-cyan btn-sm">Gửi</button>
                                        </div>
                                    </form>


                                </div>
                            </div>
                            <?php
                            else:
                            ?>
                            <h6 class="text-center text-danger">Vui Lòng Đăng Nhập Để Bình Luận</h6>

                             <?php
                            endif;
                            ?>
                    </div>
                    
                </div>
            </div>
        </div>

        <!-- Single Product Start -->
        <div class="container-fluid py-5 mt-5">
            <div class="container py-5">
                
                <h1 class="fw-bold mb-0">Related products</h1>
                <div class="vesitable">
                    <div class="owl-carousel vegetable-carousel justify-content-center">
                        <div class="border border-primary rounded position-relative vesitable-item">
                            <div class="vesitable-img">
                                <img src="<?= APP_URL ?>/public/assets/client/images/vegetable-item-1.jpg" class="img-fluid w-100 rounded-top" alt="">
                            </div>
                            <div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;">Vegetable</div>
                            <div class="p-4 pb-0 rounded-bottom">
                                <h4>Parsely</h4>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                                <div class="d-flex justify-content-between flex-lg-wrap">
                                    <p class="text-dark fs-5 fw-bold">$4.99 / kg</p>
                                    <a href="#" class="btn border border-secondary rounded-pill px-3 py-1 mb-4 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                </div>
                            </div>
                        </div>
                        <div class="border border-primary rounded position-relative vesitable-item">
                            <div class="vesitable-img">
                            <img src="<?= APP_URL ?>/public/assets/client/images/vegetable-item-2.jpg" class="img-fluid w-100 rounded-top" alt="">
                            </div>
                            <div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;">Vegetable</div>
                            <div class="p-4 pb-0 rounded-bottom">
                                <h4>Parsely</h4>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                                <div class="d-flex justify-content-between flex-lg-wrap">
                                    <p class="text-dark fs-5 fw-bold">$4.99 / kg</p>
                                    <a href="#" class="btn border border-secondary rounded-pill px-3 py-1 mb-4 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                </div>
                            </div>
                        </div>
                        <div class="border border-primary rounded position-relative vesitable-item">
                            <div class="vesitable-img">
                            <img src="<?= APP_URL ?>/public/assets/client/images/vegetable-item-2.jpg" class="img-fluid w-100 rounded-top" alt="">
                            </div>
                            <div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;">Vegetable</div>
                            <div class="p-4 pb-0 rounded-bottom">
                                <h4>Banana</h4>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                                <div class="d-flex justify-content-between flex-lg-wrap">
                                    <p class="text-dark fs-5 fw-bold">$7.99 / kg</p>
                                    <a href="#" class="btn border border-secondary rounded-pill px-3 py-1 mb-4 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                </div>
                            </div>
                        </div>
                        <div class="border border-primary rounded position-relative vesitable-item">
                            <div class="vesitable-img">
                            <img src="<?= APP_URL ?>/public/assets/client/images/vegetable-item-2.jpg" class="img-fluid w-100 rounded-top" alt="">
                            </div>
                            <div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;">Vegetable</div>
                            <div class="p-4 pb-0 rounded-bottom">
                                <h4>Bell Papper</h4>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                                <div class="d-flex justify-content-between flex-lg-wrap">
                                    <p class="text-dark fs-5 fw-bold">$7.99 / kg</p>
                                    <a href="#" class="btn border border-secondary rounded-pill px-3 py-1 mb-4 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                </div>
                            </div>
                        </div>
                        <div class="border border-primary rounded position-relative vesitable-item">
                            <div class="vesitable-img">
                            <img src="<?= APP_URL ?>/public/assets/client/images/vegetable-item-2.jpg" class="img-fluid w-100 rounded-top" alt="">
                            </div>
                            <div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;">Vegetable</div>
                            <div class="p-4 pb-0 rounded-bottom">
                                <h4>Potatoes</h4>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                                <div class="d-flex justify-content-between flex-lg-wrap">
                                    <p class="text-dark fs-5 fw-bold">$7.99 / kg</p>
                                    <a href="#" class="btn border border-secondary rounded-pill px-3 py-1 mb-4 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                </div>
                            </div>
                        </div>
                        <div class="border border-primary rounded position-relative vesitable-item">
                            <div class="vesitable-img">
                            <img src="<?= APP_URL ?>/public/assets/client/images/vegetable-item-2.jpg" class="img-fluid w-100 rounded-top" alt="">
                            </div>
                            <div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;">Vegetable</div>
                            <div class="p-4 pb-0 rounded-bottom">
                                <h4>Parsely</h4>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                                <div class="d-flex justify-content-between flex-lg-wrap">
                                    <p class="text-dark fs-5 fw-bold">$7.99 / kg</p>
                                    <a href="#" class="btn border border-secondary rounded-pill px-3 py-1 mb-4 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                </div>
                            </div>
                        </div>
                        <div class="border border-primary rounded position-relative vesitable-item">
                            <div class="vesitable-img">
                            <img src="<?= APP_URL ?>/public/assets/client/images/vegetable-item-2.jpg" class="img-fluid w-100 rounded-top" alt="">
                            </div>
                            <div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;">Vegetable</div>
                            <div class="p-4 pb-0 rounded-bottom">
                                <h4>Potatoes</h4>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                                <div class="d-flex justify-content-between flex-lg-wrap">
                                    <p class="text-dark fs-5 fw-bold">$7.99 / kg</p>
                                    <a href="#" class="btn border border-secondary rounded-pill px-3 py-1 mb-4 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                </div>
                            </div>
                        </div>
                        <div class="border border-primary rounded position-relative vesitable-item">
                            <div class="vesitable-img">
                            <img src="<?= APP_URL ?>/public/assets/client/images/vegetable-item-2.jpg" class="img-fluid w-100 rounded-top" alt="">
                            </div>
                            <div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;">Vegetable</div>
                            <div class="p-4 pb-0 rounded-bottom">
                                <h4>Parsely</h4>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                                <div class="d-flex justify-content-between flex-lg-wrap">
                                    <p class="text-dark fs-5 fw-bold">$7.99 / kg</p>
                                    <a href="#" class="btn border border-secondary rounded-pill px-3 py-1 mb-4 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Single Product End -->



<?php

    }
}
