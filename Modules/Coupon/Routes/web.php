<?php

use App\Http\Middleware\Localization;
use Illuminate\Support\Facades\Route;
use Modules\Coupon\Http\Controllers\Controller;

Route::group(['prefix' => 'dashboard', 'as' => 'admin.'], function () {
    Route::group(['middleware' => [Localization::class, 'auth:admin']], function () {
        Route::resources(['coupons' => Controller::class]);
        Route::POST('coupons/change-status/{coupon}', [Controller::class, 'changeStatus'])->name('changeStatus');

    });
});
