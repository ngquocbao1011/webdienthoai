<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id', 
        'product_id', 
        'quantity', 
        'price'
    ];

    // Quan hệ ngược lại với Sản phẩm để lấy tên, ảnh sản phẩm khi xem đơn hàng
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}