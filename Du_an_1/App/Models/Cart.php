<?php

// namespace App\Models;

// class Cart {
//     public function __construct() {
//         if (!isset($_SESSION)) {
//             session_start();
//         }
//         if (!isset($_SESSION['cart'])) {
//             $_SESSION['cart'] = [];
//         }
//     }

//     public function add($product, $quantity = 1) {
//         $id = $product['id'];
//         if (isset($_SESSION['cart'][$id])) {
//             $_SESSION['cart'][$id]['quantity'] += $quantity;
//         } else {
//             $product['quantity'] = $quantity;
//             $_SESSION['cart'][$id] = $product;
//         }
//     }

//     public function getCart() {
//         return $_SESSION['cart'];
//     }

//     public function remove($productId) {
//         if (isset($_SESSION['cart'][$productId])) {
//             unset($_SESSION['cart'][$productId]);
//         }
//     }
// }
