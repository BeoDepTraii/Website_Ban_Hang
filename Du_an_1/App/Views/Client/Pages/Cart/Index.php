<?php

namespace App\Views\Client\Pages\Cart;

use App\Helpers\SessionHelper;
use App\Views\BaseView;

class Index extends BaseView
{
    public static function render($data = null)
    {
        // Lấy giỏ hàng từ session
        $cart = SessionHelper::get('cart', []);
        ?>

        <!-- Single Page Header start -->
        <div class="container-fluid page-header py-5">
            <h1 class="text-center text-white display-6">Giỏ hàng</h1>
            <ol class="breadcrumb justify-content-center mb-0" style="background-color: transparent;">
                <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                <li class="breadcrumb-item active text-white">Giỏ hàng</li>
            </ol>
        </div>
        <!-- Single Page Header End -->

        <!-- Cart Page Start -->
        <div class="container-fluid py-5">
            <div class="container py-5">
                <?php if (!empty($cart)) : ?>

                <form method="post" action="/update_cart.php">
                    <input type="hidden" name="product_id" value="123">
                    <input type="hidden" name="action" value="increase">

                    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Sản phẩm</th>
                    <th scope="col">Tên</th>
                    <th scope="col">Giá</th>
                    <th scope="col">Số lượng</th>
                    <th scope="col">Tổng</th>
                    <th scope="col">Chỉnh sửa</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cart as $item) : ?>
                <tr>
                    <th scope="row">
                        <div class="d-flex align-items-center">
                            <img src="<?= APP_URL ?>/public/uploads/products/<?= $item['product']['image'] ?>" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="">
                        </div>
                    </th>
                    <td>
                        <p class="mb-0 mt-4"><?= $item['product']['name'] ?></p>
                    </td>
                    <td>
                        <p class="mb-0 mt-4" class="product-price" data-product-id="<?= $item['product']['id'] ?>">
                            <?= number_format($item['product']['price']) ?> VNĐ
                        </p>
                    </td>
                    <td>
                        <div class="input-group quantity mt-4" style="width: 100px;">
                            <input type="number" class="form-control form-control-sm text-center border-0 quantity-input" name="quantities[<?= $item['product']['id'] ?>]" value="<?= $item['quantity'] ?>" min="1">
                        </div>
                    </td>
                    <td>
                        <p class="mb-0 mt-4 total-price" data-product-id="<?= $item['product']['id'] ?>">
                            <?= number_format($item['product']['price'] * $item['quantity']) ?> VNĐ
                        </p>
                    </td>
                    <td>
                    <button type="submit" name="product_id" value="<?= $item['product']['id'] ?>" class="btn btn-md rounded-circle bg-light border mt-4 btn-remove" formaction="/update_cart.php?action=decrease">
                            <i class="fa fa-minus text-danger"></i>
                        </button>
                        <button type="submit" name="product_id" value="<?= $item['product']['id'] ?>" class="btn btn-md rounded-circle bg-light border mt-4 btn-remove" formaction="/update_cart.php?action=increase">
                            <i class="fa fa-plus text-success"></i>
                        </button>
                        
                        <a href="/remove_from_cart.php?product_id=<?= $item['product']['id'] ?>" class="btn btn-md rounded-circle bg-light border mt-4 btn-remove">
                            <i class="fa fa-times text-danger"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
                    <!-- Subtotal and Total Calculations -->
                    <div class="row g-4 justify-content-end">
                        <div class="col-8"></div>
                        <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                            <div class="bg-light rounded">
                                <div class="p-4">
                                    <h1 class="display-6 mb-4">Tổng <span class="fw-normal"> tiền</span></h1>
                                    <div class="d-flex justify-content-between mb-4">
                                        <h5 class="mb-0 me-4">Tạm tính:</h5>
                                        <p class="mb-0 cart-total"><?= number_format(array_sum(array_map(function($item) {
                                            return $item['product']['price'] * $item['quantity'];
                                        }, $cart))) ?> VNĐ</p>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <h5 class="mb-0 me-4">Giao hàng</h5>
                                        <div class="">
                                            <p class="mb-0">Phí ship: 30.000 VNĐ</p>
                                        </div>
                                    </div>
                                    <p class="mb-0 text-end">Giao hàng toàn quốc</p>
                                </div>
                                <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                                    <h5 class="mb-0 ps-4 me-4">Tổng</h5>
                                    <p class="mb-0 total-price" style="padding-right: 20px;">
                                        <?= number_format(array_sum(array_map(function($item) {
                                            return $item['product']['price'] * $item['quantity'];
                                        }, $cart)) + 30000) ?> VNĐ 
                                    </p>
                                </div>
                                <a href="/checkout"><button class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4" type="button">Thanh toán</button></a>
                            </div>
                        </div>
                    </div>
                </form>
                <?php else : ?>
                <p class="text-danger" style="text-align:center; font-weight: bolder;">Giỏ hàng của bạn đang trống.</p>
                <?php endif; ?>
            </div>
        </div>
        <!-- Cart Page End -->

        <?php
    }
}
