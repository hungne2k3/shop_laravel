<?php

use App\Http\Controllers\Admin\Users\LoginController;
use Illuminate\Support\Facades\Route;

// Route Login Admin
Route::get('admin/users/login', [LoginController::class, 'index']);