<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Sliders\SliderService;

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
}