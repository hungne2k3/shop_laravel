<?php

namespace App\Http\Services\Cart;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Arr;

class CartService
{
    public function create($request)
    {
        $qly = (int) $request->input('num_product');
        $product_id = (int) $request->input('product_id');

        if ($qly <= 0 || $product_id <= 0) {
            Session::flash('error', 'Số lượng sản phẩm không chính xác');

            return false;
        }

        // lấy ra toàn bộ cart
        $carts = Session::get('carts');

        // kiểm tra nếu mà $carts chưa có giỏ hàng thì sẽ tạo ra giỏ hàng
        if (is_null($carts)) {
            Session::put('carts', [
                $product_id => $qly
            ]);

            return true;
        }

        // kiểm tra xem $product_id đã tồn tại hay chưa
        $exists = Arr::exists($carts, $product_id);

        // nếu tồn tại thì cập nhập còn chưa tồn tại thì tạo 
        if ($exists) {
            $cartsNew = $carts[$product_id] + $qly;

            Session::put('carts', [
                $product_id => $cartsNew
            ]);

            return true;
        }

        Session::put('carts', [
            $product_id => $qly
        ]);

        return true;
    }
}