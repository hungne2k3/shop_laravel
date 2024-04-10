<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class MainController extends Controller
{
    public function index()
    {
        $title = 'Trang Quản Trị Admin';
        return view('admin.layout.home', compact('title'));
    }
}