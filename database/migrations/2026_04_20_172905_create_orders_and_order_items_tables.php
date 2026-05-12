<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained();
        $table->decimal('total_price', 15, 2);
        $table->string('status')->default('Processing'); // Tình trạng
        $table->text('address');
        $table->timestamps();
    });

    Schema::create('order_items', function (Blueprint $table) {
        $table->id();
        $table->foreignId('order_id')->constrained()->onDelete('cascade');
        $table->foreignId('product_id')->constrained();
        $table->integer('quantity');
        $table->decimal('price', 15, 2);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    /**
 * Reverse the migrations.
 */
public function down(): void
{
    // Xóa bảng con trước để tránh lỗi ràng buộc khóa ngoại (Foreign Key)
    Schema::dropIfExists('order_items');
    Schema::dropIfExists('orders');
}
};
