<?php

use App\Http\Middleware\Localization;
use Illuminate\Support\Facades\Route;
use Modules\Device\Http\Controllers\DeviceController;
use Modules\Device\Http\Controllers\FileController;

Route::group(['prefix' => 'dashboard', 'as' => 'admin.'], function () {
    Route::group(['middleware' => [Localization::class, 'auth:admin']], function () {
        Route::GET('devices/new_arrivals', [DeviceController::class, 'new_arrivals'])->name('devices.new_arrivals');
        Route::POST('devices/new_arrivals', [DeviceController::class, 'post_new_arrivals'])->name('devices.new_arrivals');
        Route::GET('devices/mostselling', [DeviceController::class, 'mostselling'])->name('devices.mostselling');
        Route::POST('devices/mostselling', [DeviceController::class, 'post_mostselling'])->name('devices.mostselling');
        Route::GET('devices/featured', [DeviceController::class, 'featured'])->name('devices.featured');
        Route::POST('devices/featured', [DeviceController::class, 'post_featured'])->name('devices.featured');

        Route::GET('devices/{device_id}/gallery/{color_id?}', [DeviceController::class, 'gallery'])->name('devices.gallery');
        Route::POST('devices/{device_id}/gallery/{color_id?}', [DeviceController::class, 'post_gallery'])->name('devices.gallery');
        Route::POST('devices/change-most-popular/{device}', [DeviceController::class, 'changeMostPopular'])->name('change_most_popular');


        Route::post('/change-status/{user}', [AdminController::class,'changeStatus'])->name('change.status');


        Route::resources(['devices' => DeviceController::class]);
        Route::resources(['device.features' => FeatureController::class]);
        Route::resources(['device.specs' => SpecsController::class]);
        Route::resources(['device.accessories' => AccessoryController::class]);
        Route::resources(['device.gallery' => GalleryController::class]);
        Route::resources(['device.sizes' => SizeController::class]);
        Route::resources(['device.size.colors' => ColorController::class]);
        Route::resources(['device.size.processors' => ProcessorController::class]);
        Route::resources(['device.size.processor.memories' => MemoryController::class]);
        Route::resources(['device.size.processor.memory.storages' => StorageController::class]);
        Route::resources(['device.color.images' => ColorImageController::class]);
        Route::POST('file-upload', [FileController::class, 'store'])->name('file.upload');
        Route::POST('file-remove', [FileController::class, 'destroy'])->name('file.remove');
    });
});
