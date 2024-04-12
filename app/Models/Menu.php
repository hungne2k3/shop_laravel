<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'parent_id',
        'des',
        'content',
        'active',
    ];

    // tạo ra các relationships(mối quan hệ, 1 nhiều, hay 1 to 1..)
    public function products()
    {
        // 1 danh mục có nhiều sản phẩm
        return $this->hasMany(Product::class, 'menu_id', 'id');
    }
}