<?php

namespace App\Http\Controllers\FontEndThemes\Categoty;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Menu\MenuServices;

class CategoryController extends Controller
{
    protected $menuServices;

    public function __construct(MenuServices $menuServices)
    {
        $this->menuServices = $menuServices;
    }

    //load sản phẩm menu
    public function index(Request $request, $id, $slug = '')
    {
        $menu = $this->menuServices->getId($id);

        $products = $this->menuServices->getProducts($menu, $request);

        return view('Themes.menu.menu', [
            'title' => $menu->name,
            'products' => $products,
            'menu' => $menu
        ]);
    }
}