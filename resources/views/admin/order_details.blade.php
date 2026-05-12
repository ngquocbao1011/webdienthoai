@extends('admin.layout')

@section('admin_content')
    <div style="max-width: 1200px; margin: 0 auto;">
        <a href="{{ route('admin.orders') }}" style="color: #1976d2; text-decoration: none; margin-bottom: 20px; display: inline-block;">← Quay lại</a>

        <div style="background-color: #f8f9fa; padding: 20px; border-radius: 8px; margin-bottom: 30px;">
            <h2 style="margin-top: 0; color: #333;">Đơn hàng #{{ $order->id }} - Ngày đặt: {{ $order->created_at->format('d/m/Y') }}</h2>
            <p style="margin: 10px 0; color: #666;"><strong>Trạng thái:</strong> <span style="color: #c00080; font-weight: bold; font-size: 16px;">{{ $order->status }}</span></p>
            <p style="margin: 10px 0; color: #666;"><strong>Tổng tiền:</strong> {{ number_format($order->total_price) }} VND</p>
        </div>

        <div style="background-color: #e8f5e9; padding: 20px; border-radius: 8px; margin-bottom: 30px; border-left: 4px solid #4caf50;">
            <h3 style="margin-top: 0; color: #2e7d32;">Thông tin khách hàng</h3>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div>
                    <p style="margin: 5px 0; color: #333;"><strong>Tên khách hàng:</strong> {{ $order->customer_name ?? $order->user->name }}</p>
                    <p style="margin: 5px 0; color: #333;"><strong>Số điện thoại:</strong> {{ $order->phone ?? 'Không có' }}</p>
                    <p style="margin: 5px 0; color: #333;"><strong>Email:</strong> {{ $order->user->email }}</p>
                </div>
                <div>
                    <p style="margin: 5px 0; color: #333;"><strong>Địa chỉ giao hàng:</strong> {{ $order->address }}</p>
                </div>
            </div>
        </div>

        <h3 style="color: #333; margin-bottom: 20px;">Danh sách sản phẩm đã mua:</h3>

        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 20px;">
            @foreach($order->items as $item)
            <div style="border: 1px solid #ddd; border-radius: 8px; padding: 15px; background-color: #fff; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                <img src="{{ asset('images/' . $item->product->image) }}" alt="{{ $item->product->name }}" style="width: 100%; height: 150px; object-fit: cover; border-radius: 4px; margin-bottom: 10px;">
                <p style="margin: 8px 0; font-weight: bold; color: #333;">{{ $item->product->name }}</p>
                <p style="margin: 5px 0; color: #666;"><strong>Số lượng:</strong> {{ $item->quantity }}</p>
                <p style="margin: 5px 0; color: #c00080; font-weight: bold;">Giá: {{ number_format($item->price) }} VND</p>
                <p style="margin: 5px 0; color: #333;"><strong>Tổng:</strong> {{ number_format($item->price * $item->quantity) }} VND</p>
            </div>
            @endforeach
        </div>

        <div style="text-align: right; margin-top: 40px; padding: 20px; background-color: #e3f2fd; border-radius: 8px;">
            <p style="font-size: 18px; margin: 10px 0;"><strong>Tổng cộng: {{ number_format($order->total_price) }} VND</strong></p>
        </div>
    </div>
@endsection
