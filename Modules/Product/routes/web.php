<?php

use Illuminate\Support\Facades\Route;
use Modules\Product\App\Http\Controllers\CategoryController;
use Modules\Product\App\Http\Controllers\ProductController;
use Modules\Product\App\Http\Controllers\ReviewController;

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

Route::group([], function () {
    Route::resource('products', ProductController::class)->names('products')->except('show', 'destroy');
    Route::get('products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

    Route::resource('categories', CategoryController::class)
        ->names('categories')->except('show', 'delete');
    Route::get('categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    Route::resource('reviews', ReviewController::class)
        ->names('reviews')->except('show', 'delete');
    Route::get('reviews/{category}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
});
