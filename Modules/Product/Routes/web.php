<?php

use App\Http\Middleware\Localization;
use Illuminate\Support\Facades\Route;
use Modules\Product\Http\Controllers\GalleryController;
use Modules\Product\Http\Controllers\ProductController;
use Modules\Product\Http\Controllers\FileController;

Route::group(['prefix' => 'dashboard', 'as' => 'admin.'], function () {
    Route::group(['middleware' => [Localization::class, 'auth:admin']], function () {
        Route::GET('products/new_arrivals', [ProductController::class, 'new_arrivals'])->name('products.new_arrivals');
        Route::POST('products/new_arrivals', [ProductController::class, 'post_new_arrivals'])->name('products.new_arrivals');
        Route::GET('products/mostselling', [ProductController::class, 'mostselling'])->name('products.mostselling');
        Route::POST('products/mostselling', [ProductController::class, 'post_mostselling'])->name('products.mostselling');
        Route::GET('products/featured', [ProductController::class, 'featured'])->name('products.featured');
        Route::POST('products/featured', [ProductController::class, 'post_featured'])->name('products.featured');

        Route::GET('products/{product_id}/gallery/{color_id?}', [ProductController::class, 'gallery'])->name('products.gallery');
        Route::POST('products/{product_id}/gallery/{color_id?}', [ProductController::class, 'post_gallery'])->name('products.gallery');
        Route::POST('products/change-most-popular/{product}', [ProductController::class, 'changeMostPopular'])->name('change_most_popular');


        Route::post('/change-status/{user}', [AdminController::class,'changeStatus'])->name('change.status');


        Route::resources(['products' => ProductController::class]);
        Route::resources(['product.gallery' => GalleryController::class]);
        Route::POST('file-upload', [FileController::class, 'store'])->name('file.upload');
        Route::POST('file-remove', [FileController::class, 'destroy'])->name('file.remove');
    });
});
