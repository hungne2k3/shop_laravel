<?php


namespace App\Http\Services\Product;

use App\Models\Menu;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class ProductAdminService
{
    // ham validation Price
    protected function isValidPrice($request)
    {
        // kiểm tra validation giá tiền gốc phải lớn hơn giá tiền giảm
        if ($request->input('price') !== 0 && $request->input('price_sale') !== 0 && $request->input('price_sale') >= $request->input('price')) {

            Session::flash('error', 'Giá giảm phải nhỏ hơn giá gốc');
            return false;
        }

        // Nếu giá gốc bằng 0 và giá giảm lớn hơn không thì báo lỗi
        if ($request->input('price_sale') !== 0 && (int) $request->input('price') == 0) {

            Session::flash('error', 'Vui lòng nhập giá gốc');

            return false;
        }

        return true;
    }

    public function insert($request)
    {
        $isValidPrice = $this->isValidPrice($request);

        if ($isValidPrice == false) {
            // Nếu giá trị không hợp lệ, không cần thực hiện validation và trả về false
            return false;
        }

        try {
            $request->except('_token');
            Product::create($request->all());

            Session::flash('success', 'Them san pham thanh cong');
        } catch (\Exception $err) {
            Session::flash('error', 'Them san pham that bai');

            return false;
        }

        return true;
    }

    // Hiển thị sản phẩm
    public function get()
    {
        // with('menu'): chính là responsive bên file: Posts
        return Product::with('menu')->paginate(15);
    }
}