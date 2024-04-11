<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'content',
        'menu_id',
        'price',
        'price_sale',
        'active',
        'file',
    ];

    // lấy ra menu_id để dựa vào đó hiển thị sản phẩm
    public function menu()
    {
        // chỉ lấy ra 1 cái duy nhất
        // 'id', 'menu_id': id là khóa chính, menu_id là khóa phụ
        return $this->hasOne(Menu::class, 'id', 'menu_id')->withDefault(['name' => '']);
    }
}