<?php

namespace App\Views\Client\Pages\Checkout;

use App\Views\BaseView;
use App\Controllers\Client\CheckoutController;
use App\Helpers\NotificationHelper;

class Index extends BaseView
{
    public static function render($data = null)
    {
        // Lấy dữ liệu giỏ hàng và tổng giá
        $cartData = CheckoutController::getCartData();
        $cart = $cartData['cart'];
        $totalPrice = $cartData['totalPrice'];
        ?>

        <!-- Single Page Header start -->
        <div class="container-fluid page-header py-5">
            <h1 class="text-center text-white display-6">Thanh toán</h1>
            <ol class="breadcrumb justify-content-center mb-0" style="background-color: transparent;">
                <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                <li class="breadcrumb-item active text-white">Thanh toán</li>
            </ol>
        </div>
        <!-- Single Page Header End -->



        <!-- Checkout Page Start -->
        <div class="container-fluid py-5">
            <div class="container py-5">
                <h1 class="mb-4">Billing details</h1>
                <form action="/checkout/store" method="post">
                <input type="hidden" name="method" value="POST">
                    <div class="row g-5">
                        <!-- Các trường thông tin người dùng -->
                        <!-- ... (trường thông tin giống như trong mã gốc) -->
                        <div class="col-md-12 col-lg-6 col-xl-7">
                        <div class="form-item">>
                                <input type="text" class="form-control" hidden placeholder="<?=$data['id']?>" disabled>
                            </div>
                            <div class="form-item">
                                <label class="form-label my-3" >Usernam <sup>*</sup></label>
                                <input type="text" name="username" id="username"  class="form-control" placeholder="<?=$data['username']?>" disabled>
                            </div>
                            <div class="form-item">
                                <label class="form-label my-3">Email Address<sup>*</sup></label>
                                <input type="email" class="form-control" placeholder="<?=$data['email']?>" disabled>
                            </div>
                            <div class="form-item">
                                <label class="form-label my-3">Address <sup>*</sup></label>
                                <input type="text" name="address" id="address" class="form-control" placeholder="House Number Street Name">
                            </div>
                            <div class="form-item">
                                <label class="form-label my-3">PhoneNumber<sup>*</sup></label>
                                <input type="tel" name="phonenumber" id="phonenumber" class="form-control">
                            </div>
                            
                            <div class="form-item">
                                <textarea name="text" class="form-control" spellcheck="false" cols="30" rows="11" placeholder="Oreder Notes (Optional)"></textarea>
                            </div>
                        </div>

                        <!-- Giỏ hàng -->
                        <div class="col-md-12 col-lg-6 col-xl-5">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Products</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($cart as $item): ?>
                                            <tr>
                                                <th scope="row">
                                                    <div class="d-flex align-items-center mt-2">
                                                        <img src="<?= APP_URL ?>/public/uploads/products/<?= $item ['product'] ['image'] ?>" class="img-fluid rounded-circle" style="width: 90px; height: 90px;" alt="">
                                                    </div>
                                                </th>
                                                <td class="py-5"><?= $item['product']['name'] ?></td>
                                                <td class="py-5"><?=number_format($item['product']['price'], 2) ?></td>
                                                <td class="py-5"><?=$item['quantity'] ?></td>
                                                <td class="py-5"><?=number_format($item['product']['price'] * $item['quantity'], 2) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                        <tr>
                                            <th scope="row"></th>
                                            <td class="py-5"></td>
                                            <td class="py-5"></td>
                                            <td class="py-5">
                                                <p class="mb-0 text-dark py-3">Subtotal</p>
                                            </td>
                                            <td class="py-5">
                                                <div class="py-3 border-bottom border-top">
                                                    <p class="mb-0 text-dark"><?= $totalPrice ?></p>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- Các mục khác như Shipping, TOTAL -->
                                        <!-- ... (mục khác giống như trong mã gốc) -->
                                    </tbody>
                                </table>
                            </div>
                            <div class="row g-4 text-center align-items-center justify-content-center pt-4">
                                <button type="submit" class="btn border-secondary py-3 px-4 text-uppercase w-100 text-primary">Place Order</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Checkout Page End -->

        <?php
    }
}
        