<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function create()
    {
        $title = 'Thêm danh mục';
        return view('admin.menus.add', compact('title'));
    }
}