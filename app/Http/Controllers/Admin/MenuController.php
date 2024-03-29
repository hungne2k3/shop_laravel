<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Menu\MenuServices;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Menu;

class MenuController extends Controller
{
    protected $menuServices;

    public function __construct(MenuServices $menuServices)
    {
        $this->menuServices = $menuServices;
    }

    public function index()
    {
        $title = 'Danh sách Danh Mục mới nhất';
        $menus = $this->menuServices->getAll();
        return view('admin.menus.list', compact('title', 'menus'));
    }

    public function create()
    {
        $title = 'Thêm danh mục';
        $menus = $this->menuServices->getParent();
        return view('admin.menus.add', compact('title', 'menus'));
    }

    public function postAdd(Request $request)
    {
        $rule = [
            'name' => 'required',
        ];

        $message = [
            'name.required' => 'Name bắt buộc nhập',
        ];

        $request->validate($rule, $message);

        $result = $this->menuServices->create($request);

        return redirect()->back();
    }

    public function show(Menu $id)
    {
        dd($id->name);
        $title = 'Chỉnh sửa danh mục' . $id->name;
        $menus = $id;
        return view('admin.menus.list', compact('title', 'menus'));
    }

    public function delete(Request $request): JsonResponse
    {
        $result = $this->menuServices->delete($request);

        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Xao thanh cong'
            ]);
        }

        return response()->json([
            'error' => true,
        ]);
    }
}