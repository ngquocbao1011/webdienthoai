@extends('layout')
@section('title', 'Đơn hàng')
@section('header_title', 'DANH SÁCH ĐƠN HÀNG')

@section('content')
<div class="orders-list" style="max-width: 1000px; margin: 0 auto;">
    @if($orders->count() > 0)
        @foreach($orders as $order)
        <div class="order-item" style="border: 1px solid #ddd; padding: 20px; margin-bottom: 20px; border-radius: 8px; background-color: #f9f9f9;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                <h3 style="margin: 0; color: #333;">Đơn hàng #{{ $order->id }}</h3>
                <span style="background-color: #c00080; color: white; padding: 5px 15px; border-radius: 20px; font-weight: bold;">{{ $order->status }}</span>
            </div>
            <p style="color: #666; margin: 8px 0;"><strong>Người đặt hàng:</strong> {{ $order->customer_name ?? $order->user->name }}</p>
            <p style="color: #666; margin: 8px 0;"><strong>Số điện thoại:</strong> {{ $order->phone ?? 'Không có' }}</p>
            <p style="color: #666; margin: 8px 0;"><strong>Ngày đặt:</strong> {{ $order->created_at->format('d/m/Y') }}</p>
            <p style="color: #666; margin: 8px 0;"><strong>Tổng tiền:</strong> {{ number_format($order->total_price) }} VND</p>
            <p style="color: #666; margin: 8px 0;"><strong>Địa chỉ:</strong> {{ $order->address }}</p>

            <div class="order-items" style="margin-top: 15px; border-top: 1px solid #ddd; padding-top: 15px;">
                <p style="font-weight: bold; margin-bottom: 10px;">Sản phẩm đã mua:</p>
                @foreach($order->items as $item)
                <div class="order-item-detail" style="display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #eee;">
                    <div style="flex: 1;">
                        <p style="margin: 0; color: #333;"><strong>{{ $item->product->name }}</strong></p>
                        <p style="margin: 3px 0; color: #666; font-size: 13px;">Số lượng: {{ $item->quantity }}</p>
                    </div>
                    <p style="margin: 0; text-align: right; color: #c00080; font-weight: bold;">{{ number_format($item->price) }} VND</p>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach
    @else
        <p style="text-align: center; color: #999; padding: 40px;">Bạn chưa có đơn hàng nào.</p>
    @endif
</div>
@endsection