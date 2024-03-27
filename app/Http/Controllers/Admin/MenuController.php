<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Menu\CreateFormRequest;
use App\Http\Services\Menu\MenuServices;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    protected $menuServices;

    public function __construct(MenuServices $menuServices)
    {
        $this->menuServices = $menuServices;
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
}