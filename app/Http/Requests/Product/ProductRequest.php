<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'image' => 'required',
        ];
    }

    public function message(): array
    {
        return [
            'name.required' => 'Trường này không đươc để trống',
            'image.required' => 'Trường hợp này phải chọn ảnh',
        ];
    }
}