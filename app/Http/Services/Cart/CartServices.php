<?php

namespace App\Http\Services\Cart;

use App\Jobs\SendMail;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class CartServices
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

    public function remove($id)
    {
        $carts = Session::get('carts');

        // xóa mảng
        unset($carts[$id]);

        // cập nhập lại id
        Session::put('carts', $carts);
        return true;
    }

    public function buyCart($request)
    {
        try {
            // trong quá trình chạy kiểm tra try catch mà lỗi thì sẽ ro back lại còn nếu không lỗi thì sẽ commiit
            DB::beginTransaction();

            // nếu k có sản phẩm nào trong gio hang thì trả về false
            $carts = Session::get('carts');

            if (is_null($carts)) {
                return false;
            }

            $customer = Customer::create([
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
                'email' => $request->input('email'),
                'address' => $request->input('address'),
                'content' => $request->input('content'),
            ]);


            // lấy toàn bộ thông tin chính là giá tiền (lấy giá tiền hiện tại) 
            $this->infoProductCarts($carts, $customer->id);

            DB::commit();
            Session::flash('success', 'Đặt hàng thành công');

            // Gửi Email: khi mà đặt hàng thành công thì sẽ gửi mail "dispatch()"
            SendMail::dispatch($request->input('email'))->delay(now()->addSeconds(2));

            Session::forget('carts');
        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('error', 'Đặt hàng lỗi, vui longg thử lại');

            return false;
        }

        return true;
    }

    protected function infoProductCarts($carts, $customer_id)
    {
        // lấy thông tin sản phẩm
        $productId = array_keys($carts);

        $products = Product::select('id', 'name', 'price', 'price_sale', 'file')
            ->where('active', 1)
            ->whereIn('id', $productId)
            ->get();

        $data = [];

        // duyệt mảng để trả về thông tin sản phẩm
        foreach ($products as $product) {
            // thông tin để chuyền vào 1 data
            $data[] = [
                'customer_id' => $customer_id,
                'product_id' => $product->id,
                'pty' => $carts[$product->id],
                'price' => $product->price_sale != 0 ? $product->price_sale : $product->price,
            ];
        }

        Cart::insert($data);
    }

    // Admin Cart
    public function getCustomer()
    {
        return Customer::orderByDesc('id')->paginate(15);
    }

    public function getProductForCart($customer)
    {
        return $customer->carts()->with([
            'product' => function ($query) {
                $query->select('id', 'name', 'file');
            }
        ])->get();
    }
}