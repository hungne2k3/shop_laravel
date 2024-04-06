<?php

namespace App\Http\Services\Sliders;

use App\Models\Slider;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class SliderService
{
    public function get()
    {
        return Slider::orderByDesc('id')->paginate(15);
    }

    public function insert($request)
    {
        try {
            #$request->except('_token');
            Slider::create($request->input());

            Session::flash('success', 'Thêm slider thành công');
        } catch (\Exception $e) {
            Session::flash('error', 'Thêm slider thất bại');

            Log::info($e->getMessage());

            return false;
        }

        return true;
    }

    public function update($slider, $request)
    {
        try {
            $slider->fill($request->input());
            $slider->save();

            Session::flash('success', 'Cập nhập slider thành công');
        } catch (\Exception $e) {
            Session::flash('error', 'Cập nhập slider thất bại');

            Log::info($e->getMessage());

            return false;
        }

        return true;
    }

    public function destroy($request)
    {
        $slider = Slider::where('id', $request->input('id'))->first();

        if ($slider) {
            $path = str_replace('storage', 'public', $slider->file);
            Storage::delete($path);
            $slider->delete();

            return true;
        }

        return false;
    }
}