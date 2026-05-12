<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product; // Import model vào đây

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Xóa dữ liệu cũ để tránh trùng lặp khi chạy lại lệnh
        Product::truncate(); 

        Product::insert([
            [
                'name' => 'Ốp lưng iPhone 15 Pro Max',
                'category' => 'iphone',
                'price' => 500000,
                'image' => 'iphone_case.jpg',
                'sold_count' => 10,
                'description' => 'Ốp lưng silicon cao cấp chống va đập.'
            ],
            [
                'name' => 'Củ sạc Samsung 45W',
                'category' => 'samsung',
                'price' => 450000,
                'image' => 'samsung_charger.jpg',
                'sold_count' => 5,
                'description' => 'Sạc siêu nhanh cho các dòng máy Galaxy.'
            ]
        ]);
    }
}