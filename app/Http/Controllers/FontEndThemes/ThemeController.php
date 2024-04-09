<?php

namespace App\Http\Controllers\FontEndThemes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function index()
    {
        $title = 'Shop';
        return view('Themes.DefaultLayout.main', compact('title'));
    }
}