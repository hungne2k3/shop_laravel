<?php

namespace App\Http\Controllers\FontEndThemes\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Cart\CartService;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    // chuc nang gio hang
    public function index(Request $request)
    {
        $result = $this->cartService->create($request);

        if ($result === false) {
            return redirect()->back();
        }

        return redirect('/carts');
    }

    public function show()
    {
        $products = $this->cartService->getProducts();

        return view('Themes.carts.list', [
            'title' => 'Giỏ hàng',
            'products' => $products,

            // gọi đến cart để lấy ra số lượng sản phẩm
            'carts' => Session::get('carts'),
        ]);
    }

    public function update(Request $request)
    {
        $this->cartService->update($request);

        return redirect('/carts');
    }
}