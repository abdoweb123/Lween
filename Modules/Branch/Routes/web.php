<?php

use App\Http\Middleware\Localization;
use Illuminate\Support\Facades\Route;
use Modules\Branch\Http\Controllers\Controller;

Route::group(['prefix' => 'dashboard', 'as' => 'admin.'], function () {
    Route::group(['middleware' => [Localization::class, 'auth:admin']], function () {
        Route::resources(['branches' => Controller::class]);

        Route::GET('branch/{branch}/category/{category}/categories', [Controller::class, 'editCategories'])->name('branch.categories');
        Route::POST('branch/{branch}/category/{category}/categories/update', [Controller::class, 'updateCategories'])->name('branch.category.update');
        Route::GET('branch/{branch}/category/{category}/products', [Controller::class, 'editProducts'])->name('branch.category.products');
        Route::POST('branch/{branch}/category/{category}/products/update', [Controller::class, 'updateProducts'])->name('branch.category.products.update');
    });
});
