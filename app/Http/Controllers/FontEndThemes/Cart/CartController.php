<?php

namespace App\Http\Controllers\FontEndThemes\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Cart\CartService;

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
    }
}