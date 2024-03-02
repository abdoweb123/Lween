<?php

use App\Http\Controllers\webController;
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

Route::any('change-country/{id}', [webController::class, 'SetCountry'])->name('change-country');
Route::any('get-ip-details', [webController::class, 'ip'])->name('ip');
Route::any('reorder', [webController::class, 'reorder'])->name('reorder');
Route::any('language/{locale}', [webController::class, 'lang'])->name('lang');
Route::any('artisan/{command}', [webController::class, 'artisan'])->name('artisan');
Route::any('sendotp/{number}', [webController::class, 'SendOTP'])->name('SendOTP');
Route::any('removeids', [webController::class, 'RemoveIds'])->name('RemoveIds');
Route::any('switch', [webController::class, 'switch'])->name('switch');
Route::any('country_regions/{country_id}', [webController::class, 'country_regions'])->name('country_regions');
