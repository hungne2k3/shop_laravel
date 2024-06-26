<?php

use App\Http\Controllers\Admin\CartsController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\Admin\Users\LoginController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\FontEndThemes\Cart\CartController;
use App\Http\Controllers\FontEndThemes\Categoty\CategoryController;
use App\Http\Controllers\FontEndThemes\Product\ProductsController;
use App\Http\Controllers\FontEndThemes\ThemeController;
use Illuminate\Support\Facades\Route;

// Route Login Admin
Route::get('admin/users/login', [LoginController::class, 'index'])->name('login');
Route::post('admin/users/login/store', [LoginController::class, 'store']);

// Route Admin management
Route::middleware(['auth'])->group(function () {

    Route::prefix('admin')->group(function () {
        Route::get('/', [MainController::class, 'index'])->name('admin');

        Route::get('main', [MainController::class, 'index']);

        // Menu
        Route::prefix('menus')->group(function () {
            Route::get('add', [MenuController::class, 'create']);

            Route::post('add', [MenuController::class, 'postAdd']);

            Route::get('list', [MenuController::class, 'index']);
            Route::get('edit/{id}', [MenuController::class, 'show']);
            Route::post('edit/{id}', [MenuController::class, 'update']);

            Route::delete('delete', [MenuController::class, 'delete']);
        });

        // Producte
        Route::prefix('products')->group(function () {

            // add products
            Route::get('add', [ProductController::class, 'create']);

            Route::post('add', [ProductController::class, 'store']);

            // Hiênr thị danh sách
            Route::get('list', [ProductController::class, 'index']);

            // edit danh sach
            Route::get('edit/{product}', [ProductController::class, 'show']);

            Route::post('edit/{product}', [ProductController::class, 'update']);

            Route::delete('delete', [ProductController::class, 'destroy']);
        });

        // Slider
        Route::prefix('sliders')->group(function () {

            // add slider
            Route::get('add', [SliderController::class, 'create']);

            Route::post('add', [SliderController::class, 'store']);

            // // Hiênr thị slider
            Route::get('list', [SliderController::class, 'index']);

            // // edit slider
            Route::get('edit/{slider}', [SliderController::class, 'show']);

            Route::post('edit/{slider}', [SliderController::class, 'update']);

            // delete slider
            Route::delete('delete', [SliderController::class, 'destroy']);
        });

        // upload
        Route::post('upload/services', [UploadController::class, 'store']);

        // Cart
        Route::get('customer', [CartsController::class, 'index']);

        Route::get('customer/view/{customer}', [CartsController::class, 'show']);
    });
});


Route::get('/', [ThemeController::class, 'index']);

// load more
Route::post('/services/load-product', [ThemeController::class, 'loadProduct']);

// Trang danh muc
Route::get('/danh-muc/{id}-{slug}.html', [CategoryController::class, 'index']);

// Trang sản phẩm
Route::get('/san-pham/{id}-{slug}.html', [ProductsController::class, 'index']);

// Giỏ hàng
Route::post('/add-cart', [CartController::class, 'index']);
Route::get('/carts', [CartController::class, 'show']);
Route::post('/update-cart', [CartController::class, 'update']);
Route::get('/carts/delete/{id}', [CartController::class, 'delete']);
Route::post('/carts', [CartController::class, 'buyCart']);