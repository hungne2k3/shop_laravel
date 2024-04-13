<?php

namespace App\Http\Controllers\FontEndThemes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Menu\MenuServices;
use App\Http\Services\Sliders\SliderService;
use App\Http\Services\Product\ProductService;

class ThemeController extends Controller
{
    protected $slider;
    protected $menus;
    protected $product;

    public function __construct(SliderService $slider, MenuServices $menus, ProductService $product)
    {
        $this->slider = $slider;
        $this->menus = $menus;
        $this->product = $product;
    }

    public function index()
    {
        $title = 'Shop';
        $sliders = $this->slider->show();
        $menus = $this->menus->show();
        $products = $this->product->get();
        return view('Themes.Layouts.home', compact('title', 'sliders', 'menus', 'products'));
    }

    public function loadProduct(Request $request)
    {
        $page = $request->input('page', 0);
        $result = $this->product->get($page);

        if (count($result) !== 0) {
            $html = view('Themes.products.list', ['products' => $result])->render();

            return response()->json([
                'html' => $html
            ]);
        }

        // trả về đoạn mã HTML
        return response()->json([
            'html' => ''
        ]);
    }
}