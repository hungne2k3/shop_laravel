<?php

namespace App\Http\Controllers\FontEndThemes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Menu\MenuServices;
use App\Http\Services\Sliders\SliderService;

class ThemeController extends Controller
{
    protected $sliders;
    protected $menus;

    public function __construct(SliderService $sliders, MenuServices $menus)
    {
        $this->sliders = $sliders;
        $this->menus = $menus;
    }

    public function index()
    {
        $title = 'Shop';
        $sliders = $this->sliders->show();
        $menus = $this->menus->show();
        return view('Themes.DefaultLayout.main', compact('title', 'menus'));
    }
}