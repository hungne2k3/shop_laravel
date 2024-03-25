<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        $title = 'Đăng Nhập Hệ Thống';

        return view('admin/users/login', compact('title'));
    }
}