<?php

namespace App\Http\Services\Cart;

use App\Models\Product;
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
            $carts[$product_id] = $carts[$product_id] + $qly;

            Session::put('carts', $carts);

            return true;
        }

        $carts[$product_id] = $qly;
        Session::put('carts', $carts);

        return true;
    }

    public function getProducts()
    {
        // lấy ra toàn bộ cart
        $carts = Session::get('carts');

        if (is_null($carts)) {
            return [];
        }

        // kiểm tra vị trí cuả sản phẩm
        $productId = array_keys($carts);

        return Product::select('id', 'name', 'price', 'price_sale', 'file')
            ->where('active', 1)
            ->whereIn('id', $productId)
            ->get();
    }

    public function update($request)
    {
        Session::put('carts', $request->input('num-product'));

        return true;
    }
}