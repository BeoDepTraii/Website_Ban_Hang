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
            <h1 class="text-center text-white display-6">Cart</h1>
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
        <div class="table-responsive">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Products</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total</th>
                    <th scope="col">Handle</th>
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
                                <?= number_format($item['product']['price'], 2) ?> $
                            </p>
                        </td>
                        <td>
                                <div class="input-group quantity mt-4" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-minus rounded-circle bg-light border" data-product-id="<?= $item['product']['id'] ?>" data-action="decrease">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control form-control-sm text-center border-0 quantity-input" value="<?= $item['quantity'] ?>" data-product-id="<?= $item['product']['id'] ?>">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-plus rounded-circle bg-light border" data-product-id="<?= $item['product']['id'] ?>" data-action="increase">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                        <td>
                            <p class="mb-0 mt-4 total-price" data-product-id="<?= $item['product']['id'] ?>">
                                <?= number_format($item['product']['price'] * $item['quantity'], 2) ?> $
                            </p>
                        </td>
                        <td>
                        <button class="btn btn-md rounded-circle bg-light border mt-4 btn-remove" data-product-id="<?= $item['product']['id'] ?>">
                            <i class="fa fa-times text-danger"></i>
                        </button>
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
                    <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                        <div class="d-flex justify-content-between mb-4">
                            <h5 class="mb-0 me-4">Subtotal:</h5>
                            <p class="mb-0 cart-total">$<?= number_format(array_sum(array_map(function($item) {
                                return $item['product']['price'] * $item['quantity'];
                            }, $cart)), 2) ?></p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h5 class="mb-0 me-4">Shipping</h5>
                            <div class="">
                                <p class="mb-0">Flat rate: $3.00</p>
                            </div>
                        </div>
                        <p class="mb-0 text-end">Shipping to Ukraine.</p>
                    </div>
                    <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                        <h5 class="mb-0 ps-4 me-4">Total</h5>
                        <p class="mb-0 total-price">
                            $<?= number_format(array_sum(array_map(function($item) {
                                return $item['product']['price'] * $item['quantity'];
                            }, $cart)) + 3, 2) ?>
                        </p>
                    </div>
                    <a href="/checkout"><button class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4" type="button">Thanh toán</button></a>
                </div>
            </div>
        </div>
        <?php else : ?>
        <p>Giỏ hàng của bạn đang trống.</p>
        <?php endif; ?>
    </div>
</div>
<!-- Cart Page End -->


        <?php
    }
}
