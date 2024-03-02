<?php

use App\Http\Controllers\Client\AddressController;
use App\Http\Controllers\Client\AuthController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Middleware\ForceSSL;
use App\Http\Middleware\Localization;
use Illuminate\Support\Facades\Route;
use Modules\Client\Http\Controllers\ClientLoginController;
use Modules\Device\Http\Controllers\DeviceController;
use Modules\Category\Http\Controllers\Controller as CategoryController;

Route::group(['as' => 'Client.', 'middleware' => [Localization::class, ForceSSL::class]], function () {
    Route::GET('/', [HomeController::class, 'home'])->name('home');
    Route::GET('/device/{device_id?}/{color_id?}', [HomeController::class, 'device'])->name('device');
    Route::GET('/build-your-device/{device_id?}/{color_id}', [HomeController::class, 'BuildYourDevice'])->name('BuildYourDevice');
    Route::any('/categories/{category?}', [HomeController::class, 'categories'])->name('categories');
    Route::GET('/shoping-cart', [HomeController::class, 'cart'])->name('cart');
    Route::POST('/check-out/{delivery_id?}', [HomeController::class, 'confirm'])->name('confirm');
    Route::POST('/place-order/{delivery_id}', [HomeController::class, 'submit'])->name('submit');
    Route::GET('devices/details/{id}', [DeviceController::class, 'get_details'])->name('devices.details');
    Route::any('get/category/{id}/devices/{searchBy?}', [DeviceController::class, 'getCategoryDevices'])->name('category.devices');
    Route::get('get/all/products/{searchBy?}', [DeviceController::class, 'getAllProducts'])->name('allProducts');
    Route::get('get/all/categories/', [HomeController::class, 'getAllCategories'])->name('getAllCategories');
    Route::any('change/website/settings', [HomeController::class, 'changeWebsiteSettings'])->name('changeWebsiteSettings');
    Route::GET('get-regions/of/country', [HomeController::class, 'getRegionsOfCountry'])->name('getRegionsOfCountry');


    Route::POST('/toggle-wishlist', [HomeController::class, 'ToggleWishlist'])->name('ToggleWishlist');

    Route::POST('/cart-delete', [HomeController::class, 'deleteitem'])->name('deleteitem');
    Route::POST('/cart-plus', [HomeController::class, 'plus'])->name('plus');
    Route::POST('/cart-minus', [HomeController::class, 'minus'])->name('minus');

    Route::view('/services', 'Client.services')->name('services');
    Route::view('/faq', 'Client.faq')->name('faq');
    Route::view('/about', 'Client.about')->name('about');
    Route::view('/terms', 'Client.terms')->name('terms');
    Route::view('/contact', 'Client.contact')->name('contact');
    Route::view('/privacy', 'Client.privacy')->name('privacy');
    Route::view('/replacement_and_after_sales_service', 'Client.policy')->name('policy');

    Route::any('/report/{device_id}/{size_id}/{color_id}/{specification_id}', [HomeController::class, 'report'])->name('report');
    Route::POST('/contact', [HomeController::class, 'contact'])->name('contact');

    Route::group(['middleware' => ['guest:client']], function () {
        Route::view('/login', 'Client.login')->name('login');
        Route::POST('/login', [AuthController::class, 'login'])->name('login');

        Route::view('/register', 'Client.register')->name('register');

        // register user with status = 0 && send OTP to user phone
        Route::POST('/register', [AuthController::class, 'register'])->name('register');

        Route::view('/forget', 'Client.forget')->name('forget');
        Route::POST('/forget', [AuthController::class, 'forget'])->name('forget');
    });

    // Go to OTP Page
    Route::get('OTP/{id}', [ClientLoginController::class, 'showOtp'])->name('otp');
    // Send OTP
    Route::post('verifyOtp/{id}', [ClientLoginController::class, 'verifyOtp'])->name('verifyOtp');
    // Resend OTP
    Route::post('resend/OTP', [ClientLoginController::class, 'Resend'])->name('resend_otp');

    Route::group(['middleware' => ['auth:client','ClientIsActive']], function () {
        Route::view('/profile/{type?}', 'Client.profile')->name('profile');
        Route::POST('/profile', [AuthController::class, 'profile'])->name('profile');
        Route::resource('/address', AddressController::class);
        Route::any('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::POST('/add-to-cart', [HomeController::class, 'AddToCart'])->name('AddToCart');
    });

});
