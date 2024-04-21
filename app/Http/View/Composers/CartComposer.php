<?php

namespace App\Http\View\Composers;

use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use App\Models\Product;


class CartComposer
{
    public function __construct()
    {

    }


    public function compose(View $view)
    {
        // lấy ra những id mà có của Session
        // lấy ra toàn bộ cart
        $carts = Session::get('carts');

        if (is_null($carts)) {
            return [];
        }

        // kiểm tra vị trí cuả sản phẩm
        $productId = array_keys($carts);

        $products = Product::select('id', 'name', 'price', 'price_sale', 'file')
            ->where('active', 1)
            ->whereIn('id', $productId)
            ->get();

        // bien menus de nhan data
        $view->with('products', $products);
    }
}