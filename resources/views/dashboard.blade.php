@extends('layout')
@section('title', 'Dashboard')
@section('header_title', 'CHÀO MỪNG BẠN ĐẾN VỚI QUOC BAO STORE')

@section('content')
<div class="dashboard">
    <h2>Thông tin tài khoản</h2>
    <p><strong>Tên:</strong> {{ Auth::user()->name }}</p>
    <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
    <p><strong>Ngày tham gia:</strong> {{ Auth::user()->created_at->format('d/m/Y') }}</p>

    <h3>Đơn hàng gần đây</h3>
    @if(Auth::user()->orders->count() > 0)
        <ul>
            @foreach(Auth::user()->orders->take(5) as $order)
            <li>Đơn hàng #{{ $order->id }} - {{ $order->status }} - {{ number_format($order->total_price) }} VND</li>
            @endforeach
        </ul>
        <a href="{{ url('/don-hang') }}">Xem tất cả đơn hàng</a>
    @else
        <p>Bạn chưa có đơn hàng nào.</p>
    @endif
</div>
@endsection