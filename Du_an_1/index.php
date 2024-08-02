<?php
session_start();
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
ini_set('log_errors', TRUE); 


// Kiểm tra có file log chưa? Chưa -> tạo file và lưu vào    Có -> lưu vào luôn
ini_set('error_log', './logs/php/php-errors.log');



use App\Route;

require_once 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

require_once 'config.php';



// *** Client
Route::get('/', 'App\Controllers\Client\HomeController@index');
Route::get('/products', 'App\Controllers\Client\ProductController@index');
Route::get('/products/{id}', 'App\Controllers\Client\ProductController@detail');

Route::get('/contact', 'App\Controllers\Client\ContactController@index');

Route::get('/register', 'App\Controllers\Client\AuthController@register');   //Route đăng ký
Route::post('/register', 'App\Controllers\Client\AuthController@registerAction');   //Route đăng ký


Route::get('/login', 'App\Controllers\Client\AuthController@login');   //Route đăng nhập
Route::post('/login', 'App\Controllers\Client\AuthController@loginAction');   //Route đăng nhập


Route::get('/logout', 'App\Controllers\Client\AuthController@logout');   //Route đăng xuất


Route::get('/users/{id}', 'App\Controllers\Client\AuthController@edit');   //Route thông tin người dùng
Route::put('/users/{id}', 'App\Controllers\Client\AuthController@update');   //Route thông tin người dùng


Route::get('/change-password', 'App\Controllers\Client\AuthController@changePassword');   //Route đổi mật khẩu
Route::put('/change-password', 'App\Controllers\Client\AuthController@changePasswordAction');   //Route đổi mật khẩu



// *** Admin

Route::get('/admin', 'App\Controllers\Admin\HomeController@index');

//  *** Category
// GET /categories (lấy danh sách loại sản phẩm)
Route::get('/admin/categories', 'App\Controllers\Admin\CategoryController@index');

// GET /categories/create (hiển thị form thêm loại sản phẩm)
Route::get('/admin/categories/create', 'App\Controllers\Admin\CategoryController@create');

// POST /categories (tạo mới một loại sản phẩm)
Route::post('/admin/categories', 'App\Controllers\Admin\CategoryController@store');

// GET /categories/{id} (lấy chi tiết loại sản phẩm với id cụ thể)
Route::get('/admin/categories/{id}', 'App\Controllers\Admin\CategoryController@edit');

// PUT /categories/{id} (update loại sản phẩm với id cụ thể)
Route::put('/admin/categories/{id}', 'App\Controllers\Admin\CategoryController@update');

// DELETE /categories/{id} (delete loại sản phẩm với id cụ thể)
Route::delete('/admin/categories/{id}', 'App\Controllers\Admin\CategoryController@delete');


//  *** Product
// GET /products (lấy danh sách sản phẩm)
Route::get('/admin/products', 'App\Controllers\Admin\ProductController@index');

// GET /products/create (hiển thị form thêm sản phẩm)
Route::get('/admin/products/create', 'App\Controllers\Admin\ProductController@create');

// POST /products (tạo mới một sản phẩm)
Route::post('/admin/products', 'App\Controllers\Admin\ProductController@store');

// GET /products/{id} (lấy chi tiết sản phẩm với id cụ thể)
Route::get('/admin/products/{id}', 'App\Controllers\Admin\ProductController@edit');

// PUT /products/{id} (update sản phẩm với id cụ thể)
Route::put('/admin/products/{id}', 'App\Controllers\Admin\ProductController@update');

// DELETE /products/{id} (delete sản phẩm với id cụ thể)
Route::delete('/admin/products/{id}', 'App\Controllers\Admin\ProductController@delete');




Route::dispatch($_SERVER['REQUEST_URI']);
