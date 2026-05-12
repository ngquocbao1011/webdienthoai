<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Chạy migration để tạo bảng.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');          // Tên linh kiện (iPhone 15, Sạc Samsung...)
            $table->string('category');      // iphone hoặc samsung
            $table->decimal('price', 15, 2);  // Giá bán
            $table->string('image');         // Tên file ảnh (iphone.jpg)
            $table->integer('sold_count')->default(0); // Số lượng đã bán
            $table->text('description')->nullable();   // Mô tả chi tiết
            $table->timestamps();
        });
    }

    /**
     * Hoàn tác migration.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};