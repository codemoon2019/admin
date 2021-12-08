<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::get('/login', [App\Http\Controllers\HomeController::class, 'login'])->name('login');
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
Route::post('/authenticate', [App\Http\Controllers\HomeController::class, 'authenticateUser'])->name('authenticate-user');

Route::group(['middleware' => 'auth'], function (){

    Route::get('/', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('home');
    Route::get('/my-profile', [App\Http\Controllers\Admin\AdminController::class, 'myProfile'])->name('my-profile');
    Route::post('/upload-user-image', [App\Http\Controllers\Admin\AdminController::class, 'uploadUserImage'])->name('upload-user-image');
    Route::post('/update-user-profile', [App\Http\Controllers\Admin\AdminController::class, 'uploadUserProfile'])->name('update-user-profile');

    Route::namespace("Notification")->prefix("notification")->name("notification.")->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\NotificationController::class, 'index'])->name('notification');
        Route::get('/notification-list', [App\Http\Controllers\Admin\NotificationController::class, 'notifList'])->name('notification-list');
        Route::get('/notification-header-list', [App\Http\Controllers\Admin\NotificationController::class, 'notifHeaderList'])->name('notification-header-list');
    });
    
    Route::namespace("Product")->prefix("product")->name("product.")->group(function () {
        Route::get('/create-product', [App\Http\Controllers\Admin\ProductController::class, 'index'])->name('create-product');
        Route::post('/update-product', [App\Http\Controllers\Admin\ProductController::class, 'updateProduct'])->name('update-product');
        Route::get('/inventory', [App\Http\Controllers\Admin\ProductController::class, 'inventory'])->name('inventory');
        Route::post('/send-create-product', [App\Http\Controllers\Admin\ProductController::class, 'createProduct'])->name('send-create-product');
        Route::post('/product-list', [App\Http\Controllers\Admin\ProductController::class, 'productList'])->name('product-list');
        Route::get('/retrieve-single-product-info/{id}', [App\Http\Controllers\Admin\ProductController::class, 'retrieveSingleProductInfo'])->name('retrieve-single-product-info');
        Route::post('/delete-product-image', [App\Http\Controllers\Admin\ProductController::class, 'deleteProductImage'])->name('delete-product-image');
        Route::post('/delete-product', [App\Http\Controllers\Admin\ProductController::class, 'deleteProduct'])->name('delete-product');
    });

    Route::namespace("Order")->prefix("order")->name("order.")->group(function () {
        Route::get('/history', [App\Http\Controllers\Admin\OrderController::class, 'orderhistory'])->name('history');
        Route::get('/new', [App\Http\Controllers\Admin\OrderController::class, 'neworder'])->name('new');
        Route::post('/new-order-list-user', [App\Http\Controllers\Admin\OrderController::class, 'newOrderListUser'])->name('new-order-list-user');
        Route::post('/new-order-list-guest', [App\Http\Controllers\Admin\OrderController::class, 'newOrderListGuest'])->name('new-order-list-guest');
        Route::get('/order-details/{id}', [App\Http\Controllers\Admin\OrderController::class, 'orderDetails'])->name('order-details');
        Route::get('/guest-order-details/{id}', [App\Http\Controllers\Admin\OrderController::class, 'guestOrderDetails'])->name('guest-order-details');
        Route::get('/order-receipt/{id}', [App\Http\Controllers\Admin\OrderController::class, 'orderReceipt'])->name('order-receipt');
        Route::get('/guest-order-receipt/{id}', [App\Http\Controllers\Admin\OrderController::class, 'guestOrderReceipt'])->name('guest-order-receipt');
        Route::post('/update-customer-order', [App\Http\Controllers\Admin\OrderController::class, 'updateOrder'])->name('update-order');
        Route::post('/update-all-customer-order', [App\Http\Controllers\Admin\OrderController::class, 'updateAllOrder'])->name('update-all-order');
        Route::post('/update-driver', [App\Http\Controllers\Admin\OrderController::class, 'updateDriver'])->name('update-driver');
        Route::post('/update-multiple-order-status', [App\Http\Controllers\Admin\OrderController::class, 'updateMultipleOrderStatus'])->name('update-multiple-order-status');
    });

    Route::namespace("System")->prefix("system")->name("system.")->group(function () {

        Route::post('/user-list', [App\Http\Controllers\Admin\SystemController::class, 'userList'])->name('user-list');
        Route::post('/driver-list', [App\Http\Controllers\Admin\SystemController::class, 'driverList'])->name('driver-list');
        Route::post('/register-driver', [App\Http\Controllers\Admin\SystemController::class, 'registerDriver'])->name('register-driver');
        Route::post('/register-admin', [App\Http\Controllers\Admin\SystemController::class, 'registerAdmin'])->name('register-admin');
        Route::get('/system-users', [App\Http\Controllers\Admin\SystemController::class, 'systemUsers'])->name('system-users');
        Route::post('/system-user-list', [App\Http\Controllers\Admin\SystemController::class, 'userList'])->name('system-user-list');

        Route::get('/emails', [App\Http\Controllers\Admin\SystemController::class, 'emails'])->name('emails');
        Route::get('/signup-emails', [App\Http\Controllers\Admin\SystemController::class, 'signupEmails'])->name('signup-emails');

        Route::get('/driver', [App\Http\Controllers\Admin\SystemController::class, 'driver'])->name('driver');
        Route::get('/website-blogs', [App\Http\Controllers\Admin\SystemController::class, 'websiteBlogs'])->name('website-blogs');
        Route::post('/create-website-blog', [App\Http\Controllers\Admin\SystemController::class, 'createWebsiteBlog'])->name('create-website-blog');
        Route::post('/update-website-blog', [App\Http\Controllers\Admin\SystemController::class, 'updateWebsiteBlog'])->name('update-website-blog');
        Route::post('/website-blog-list', [App\Http\Controllers\Admin\SystemController::class, 'websiteBlogList'])->name('website-blog-list');

    });

});