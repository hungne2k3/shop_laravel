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

    public function update($id, $request): bool
    {
        // nếu parent_id vs id thì sẽ bị lỗi khi update vì vậy viết hàm kiểm tra nếu khác nhau thì cho sửa đổi, còn giống nhau thì không cho
        if ($request->input('parent_id') != $id->id) {

            $id->parent_id = (int) $request->input('parent_id');
        }


        $id->name = (string) $request->input('name');
        $id->des = (string) $request->input('des');
        $id->content = (string) $request->input('content');
        $id->active = (string) $request->input('active');

        $id->save();
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