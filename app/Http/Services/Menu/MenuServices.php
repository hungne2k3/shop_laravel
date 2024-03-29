<?php

namespace App\Http\Services\Menu;

use App\Models\Menu;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class MenuServices
{
    public function getParent()
    {
        // Nếu parent_id == 0 thì lấy toàn bộ view
        return Menu::where('parent_id', 0)->get();
    }

    // phan trang
    public function getAll()
    {
        return Menu::orderByDesc('id')->paginate(10);
    }

    public function create($request)
    {
        try {
            Menu::create([
                'name' => (string) $request->input('name'),
                'parent_id' => (int) $request->input('parent_id'),
                'des' => (string) $request->input('des'),
                'content' => (string) $request->input('content'),
                'active' => (string) $request->input('active'),
            ]);

            Session::flash('success', 'Tạo danh mục thành công');
        } catch (\Exception $e) {
            Session::flash('error', $e->getMessage());
            return false;
        }

        return true;
    }

    public function delete($request)
    {
        $id = (int) $request->input('id');

        $menu = Menu::where('id', $id)->first();

        if ($menu) {
            return Menu::where('id', $id)->orWhere('parent_id', $id)->delete();
        }

        return false;
    }
}