<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Khai báo tên bảng (nếu bạn đặt tên bảng ở migration là products thì không cần dòng này, nhưng nên có cho chắc)
    protected $table = 'products';

    // Cho phép nạp dữ liệu hàng loạt vào các cột này (Quan trọng để Seeder chạy được)
    protected $fillable = [
        'name',
        'category',
        'price',
        'image',
        'sold_count',
        'description'
    ];
}