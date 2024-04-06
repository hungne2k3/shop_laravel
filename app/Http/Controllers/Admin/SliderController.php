<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Sliders\SliderService;
use App\Models\Slider;

class SliderController extends Controller
{
    protected $slider;

    public function __construct(SliderService $slider)
    {
        $this->slider = $slider;
    }

    public function index()
    {
        $title = 'Danh sách các Slider';
        $sliders = $this->slider->get();
        return view('admin.Sliders.list', compact('title', 'sliders'));
    }

    public function create()
    {
        $title = 'Thêm Slider mới';
        return view('admin.Sliders.add', compact('title'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'file' => 'required',
            'url' => 'required',
        ]);

        $this->slider->insert($request);

        return redirect()->back();
    }

    public function show(Slider $slider)
    {
        return view('admin.Sliders.edit', [
            'title' => 'Chỉnh sửa Slider',
            'slider' => $slider
        ]);
    }

    public function update(Request $request, Slider $slider)
    {
        $this->validate($request, [
            'name' => 'required',
            'file' => 'required',
            'url' => 'required',
        ]);

        $result = $this->slider->update($slider, $request);

        if ($result) {
            return redirect('admin/sliders/list');
        }

        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $result = $this->slider->destroy($request);

        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Xóa thành công',
            ]);
        }

        return response()->json([
            'error' => true,
        ]);
    }
}