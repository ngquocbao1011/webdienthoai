<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Khai báo các cột có thể nạp dữ liệu hàng loạt
    protected $fillable = [
        'user_id',
        'customer_name',
        'phone',
        'total_price',
        'status',
        'address'
    ];

    /**
     * Quan hệ 1 đơn hàng có nhiều sản phẩm chi tiết
     */
    public function items() 
    {
        // Chắc chắn rằng bạn đã tạo file OrderItem.php trong thư mục Models
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Quan hệ đơn hàng thuộc về một người dùng (để hiển thị tên người mua)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Tự động cập nhật trạng thái đơn hàng sau 1 ngày
     */
    public function autoUpdateStatus()
    {
        $now = now();
        $daysPassed = $this->created_at->diffInDays($now);

        if ($daysPassed >= 1 && $daysPassed < 2 && $this->status === 'Đang xử lý') {
            $this->update(['status' => 'Đã xử lý']);
        } elseif ($daysPassed >= 2 && $daysPassed < 3 && $this->status === 'Đã xử lý') {
            $this->update(['status' => 'Đang giao hàng']);
        } elseif ($daysPassed >= 3 && $this->status === 'Đang giao hàng') {
            $this->update(['status' => 'Đã hoàn thành']);
        }

        return $this;
    }
}