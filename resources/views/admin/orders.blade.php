@extends('admin.layout')

@section('admin_content')
    <div style="display: flex; gap: 10px; margin-bottom: 20px;">
        <a href="{{ route('admin.orders') }}" style="border: 1px solid #c00080; background: white; color: #c00080; padding: 10px 20px; cursor: pointer; text-decoration: none; display: inline-block;">Tất cả</a>
        <a href="{{ route('admin.orders', ['status' => 'Đang xử lý']) }}" style="border: 1px solid #c00080; background: {{ request('status') == 'Đang xử lý' ? '#c00080' : 'white' }}; color: {{ request('status') == 'Đang xử lý' ? 'white' : '#c00080' }}; padding: 10px 20px; cursor: pointer; text-decoration: none; display: inline-block;">Đang xử lý</a>
        <a href="{{ route('admin.orders', ['status' => 'Đã xử lý']) }}" style="border: 1px solid #c00080; background: {{ request('status') == 'Đã xử lý' ? '#c00080' : 'white' }}; color: {{ request('status') == 'Đã xử lý' ? 'white' : '#c00080' }}; padding: 10px 20px; cursor: pointer; text-decoration: none; display: inline-block;">Đã xử lý</a>
        <a href="{{ route('admin.orders', ['status' => 'Đang giao hàng']) }}" style="border: 1px solid #c00080; background: {{ request('status') == 'Đang giao hàng' ? '#c00080' : 'white' }}; color: {{ request('status') == 'Đang giao hàng' ? 'white' : '#c00080' }}; padding: 10px 20px; cursor: pointer; text-decoration: none; display: inline-block;">Đang giao hàng</a>
        <a href="{{ route('admin.orders', ['status' => 'Đã hoàn thành']) }}" style="border: 1px solid #c00080; background: {{ request('status') == 'Đã hoàn thành' ? '#c00080' : 'white' }}; color: {{ request('status') == 'Đã hoàn thành' ? 'white' : '#c00080' }}; padding: 10px 20px; cursor: pointer; text-decoration: none; display: inline-block;">Đã hoàn thành</a>
    </div>

    <table style="width: 100%; border-collapse: collapse; text-align: center; border: 1px solid #f0a0d0; font-size: 14px;">
        <thead style="background-color: #f8d7eb;">
            <tr>
                <th style="padding: 10px; border: 1px solid #f0a0d0;">STT</th>
                <th style="padding: 10px; border: 1px solid #f0a0d0;">Mã đơn hàng</th>
                <th style="padding: 10px; border: 1px solid #f0a0d0;">Ngày đặt</th>
                <th style="padding: 10px; border: 1px solid #f0a0d0;">Tên khách</th>
                <th style="padding: 10px; border: 1px solid #f0a0d0;">Số điện thoại</th>
                <th style="padding: 10px; border: 1px solid #f0a0d0;">Doanh thu</th>
                <th style="padding: 10px; border: 1px solid #f0a0d0;">Tình trạng</th>
                <th style="padding: 10px; border: 1px solid #f0a0d0;">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $index => $order)
            <tr>
                <td style="padding: 12px; border: 1px solid #f0a0d0;">{{ $index + 1 }}</td>
                <td style="padding: 12px; border: 1px solid #f0a0d0;">#{{ $order->id }}</td>
                <td style="padding: 12px; border: 1px solid #f0a0d0;">{{ $order->created_at->format('d/m/Y') }}</td>
                <td style="padding: 12px; border: 1px solid #f0a0d0;">{{ $order->customer_name ?? $order->user->name }}</td>
                <td style="padding: 12px; border: 1px solid #f0a0d0;">{{ $order->phone ?? 'N/A' }}</td>
                <td style="padding: 12px; border: 1px solid #f0a0d0; color: #c00080; font-weight: bold;">{{ number_format($order->total_price) }} VND</td>
                <td style="padding: 12px; border: 1px solid #f0a0d0;">
                    <span style="background-color:
                        {{ $order->status === 'Processing' ? '#fff3cd' : ($order->status === 'Đang xử lý' ? '#fff3cd' : ($order->status === 'Đã xử lý' ? '#d4edda' : ($order->status === 'Đang giao hàng' ? '#cfe2ff' : '#d1ecf1'))) }};
                        padding: 5px 10px; border-radius: 4px; font-size: 12px;">
                        {{ $order->status }}
                    </span>
                </td>
                <td style="padding: 12px; border: 1px solid #f0a0d0;">
                    <a href="{{ route('admin.order.details', $order->id) }}" style="color: blue; text-decoration: none;">Chi tiết</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @if($orders->count() == 0)
        <div style="text-align: center; padding: 20px; color: #999;">
            Không có đơn hàng nào.
        </div>
    @endif

    <div style="text-align: center; margin-top: 100px; color: #888; font-size: 13px;">
    
    </div>
@endsection