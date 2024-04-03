<?php

use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\Admin\Users\LoginController;
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
            Route::get('add', [ProductController::class, 'create']);

            Route::post('add', [ProductController::class, 'store']);

            Route::get('list', [ProductController::class, 'index']);

            Route::get('edit/{product}', [ProductController::class, 'show']);
        });

        // upload
        Route::post('upload/services', [UploadController::class, 'store']);
    });
});