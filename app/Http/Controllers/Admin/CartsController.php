<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Cart\CartServices;
use App\Models\Customer;

class CartsController extends Controller
{
    protected $carts;

    public function __construct(CartServices $carts)
    {
        $this->carts = $carts;
    }

    public function index()
    {
        $title = 'Danh sách đơn đặt hàng';
        $customers = $this->carts->getCustomer();

        return view('Admin.Cart.customer', compact('title', 'customers'));
    }

    public function show(Customer $customer)
    {
        $carts = $this->carts->getProductForCart($customer);

        return view('Admin.Cart.show', [
            'title' => 'Chi tiết đơn hàng: ' . $customer->name,
            'customer' => $customer,
            'carts' => $carts
        ]);
    }
}