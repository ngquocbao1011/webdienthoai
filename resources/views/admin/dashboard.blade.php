@extends('admin.layout')

@section('admin_content')
<div style="max-width: 1400px; margin: 0 auto;">
    <h2 style="margin-bottom: 30px; color: #333;">Bảng Điều Khiển</h2>

    <!-- Các chỉ số chính -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 40px;">
        <!-- Tổng doanh thu -->
        <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
            <h3 style="margin: 0 0 10px 0; font-size: 14px; opacity: 0.9;">Tổng Doanh Thu</h3>
            <p style="margin: 0; font-size: 32px; font-weight: bold;">{{ number_format($totalRevenue) }} VND</p>
        </div>

        <!-- Tổng số đơn hàng -->
        <div style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
            <h3 style="margin: 0 0 10px 0; font-size: 14px; opacity: 0.9;">Tổng Số Đơn Hàng</h3>
            <p style="margin: 0; font-size: 32px; font-weight: bold;">{{ $totalOrders }}</p>
        </div>

        <!-- Doanh thu trung bình -->
        <div style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
            <h3 style="margin: 0 0 10px 0; font-size: 14px; opacity: 0.9;">Doanh Thu Trung Bình</h3>
            <p style="margin: 0; font-size: 32px; font-weight: bold;">{{ $totalOrders > 0 ? number_format($totalRevenue / $totalOrders) : '0' }} VND</p>
        </div>
    </div>

    <!-- Biểu đồ doanh thu theo tháng -->
    <div style="background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); margin-bottom: 40px;">
        <h3 style="margin-top: 0; color: #333; margin-bottom: 20px;">Doanh Thu Theo Tháng (12 Tháng Gần Đây)</h3>

        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; text-align: center;">
                <thead style="background-color: #f0a0d0;">
                    <tr>
                        <th style="padding: 12px; border: 1px solid #ddd;">Tháng</th>
                        <th style="padding: 12px; border: 1px solid #ddd;">Doanh Thu</th>
                        <th style="padding: 12px; border: 1px solid #ddd;">Biểu Đồ</th>
                    </tr>
                </thead>
                <tbody>
                    @if($revenueByMonth->count() > 0)
                        @php
                            $maxRevenue = $revenueByMonth->max('total');
                        @endphp
                        @foreach($revenueByMonth as $revenue)
                        <tr>
                            <td style="padding: 12px; border: 1px solid #ddd; font-weight: bold;">{{ $revenue->month_name }} {{ $revenue->year }}</td>
                            <td style="padding: 12px; border: 1px solid #ddd; color: #c00080; font-weight: bold;">{{ number_format($revenue->total) }} VND</td>
                            <td style="padding: 12px; border: 1px solid #ddd;">
                                <div style="background-color: #f0f0f0; border-radius: 4px; height: 30px; display: flex; align-items: center; overflow: hidden;">
                                    <div style="height: 100%; background: linear-gradient(90deg, #667eea 0%, #764ba2 100%); width: {{ $maxRevenue > 0 ? ($revenue->total / $maxRevenue * 100) : 0 }}%; display: flex; align-items: center; justify-content: flex-end; padding-right: 8px; color: white; font-size: 12px; font-weight: bold;">
                                        {{ $maxRevenue > 0 ? round(($revenue->total / $maxRevenue * 100), 0) : 0 }}%
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="3" style="padding: 20px; color: #999;">Chưa có dữ liệu doanh thu</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <!-- Đơn hàng theo trạng thái -->
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px; margin-bottom: 40px;">
        <div style="background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
            <h3 style="margin-top: 0; color: #333; margin-bottom: 20px;">Đơn Hàng Theo Trạng Thái</h3>

            @if($ordersByStatus->count() > 0)
                @php
                    $statusColors = [
                        'Processing' => '#ffc107',
                        'Đang xử lý' => '#ffc107',
                        'Đã xử lý' => '#28a745',
                        'Đang giao hàng' => '#17a2b8',
                        'Đã hoàn thành' => '#20c997'
                    ];
                @endphp
                <div style="display: flex; flex-direction: column; gap: 15px;">
                    @foreach($ordersByStatus as $status)
                    <div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                            <strong style="color: #333;">{{ $status->status }}</strong>
                            <span style="color: #666; font-weight: bold;">{{ $status->total }} đơn</span>
                        </div>
                        <div style="background-color: #f0f0f0; border-radius: 4px; height: 25px; overflow: hidden;">
                            <div style="height: 100%; background-color: {{ $statusColors[$status->status] ?? '#999' }}; width: {{ $totalOrders > 0 ? ($status->total / $totalOrders * 100) : 0 }}%; display: flex; align-items: center; justify-content: center; color: white; font-size: 11px; font-weight: bold;">
                                {{ $totalOrders > 0 ? round(($status->total / $totalOrders * 100), 0) : 0 }}%
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <p style="color: #999; text-align: center; padding: 20px;">Chưa có dữ liệu</p>
            @endif
        </div>

        <!-- Top 5 sản phẩm bán chạy -->
        <div style="background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
            <h3 style="margin-top: 0; color: #333; margin-bottom: 20px;">Top 5 Sản Phẩm Bán Chạy</h3>

            @if($topProducts->count() > 0)
                <div style="display: flex; flex-direction: column; gap: 15px;">
                    @foreach($topProducts as $index => $item)
                    <div style="display: flex; align-items: center; gap: 15px; padding: 10px; background-color: #f9f9f9; border-radius: 4px;">
                        <div style="width: 40px; height: 40px; background-color: #667eea; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; flex-shrink: 0;">
                            {{ $index + 1 }}
                        </div>
                        <div style="flex: 1; min-width: 0;">
                            <p style="margin: 0 0 5px 0; font-weight: bold; color: #333; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $item->product->name }}</p>
                            <p style="margin: 0; color: #666; font-size: 13px;">Đã bán: <strong>{{ $item->total_quantity }}</strong> sản phẩm</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <p style="color: #999; text-align: center; padding: 20px;">Chưa có dữ liệu</p>
            @endif
        </div>
    </div>

    <!-- Liên kết nhanh -->
    <div style="background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
        <h3 style="margin-top: 0; color: #333; margin-bottom: 20px;">Liên Kết Nhanh</h3>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px;">
            <a href="{{ route('admin.orders') }}" style="display: flex; align-items: center; gap: 15px; padding: 15px; background-color: #f0a0d0; border-radius: 4px; text-decoration: none; color: white; transition: all 0.3s ease;">
                <span style="font-size: 24px;">📋</span>
                <div>
                    <p style="margin: 0; font-weight: bold;">Quản Lý Đơn Hàng</p>
                    <p style="margin: 0; font-size: 12px; opacity: 0.9;">Xem tất cả đơn hàng</p>
                </div>
            </a>

            <a href="{{ route('admin.products') }}" style="display: flex; align-items: center; gap: 15px; padding: 15px; background-color: #667eea; border-radius: 4px; text-decoration: none; color: white; transition: all 0.3s ease;">
                <span style="font-size: 24px;">📦</span>
                <div>
                    <p style="margin: 0; font-weight: bold;">Quản Lý Sản Phẩm</p>
                    <p style="margin: 0; font-size: 12px; opacity: 0.9;">Quản lý danh sách sản phẩm</p>
                </div>
            </a>

            <a href="{{ route('admin.categories') }}" style="display: flex; align-items: center; gap: 15px; padding: 15px; background-color: #4caf50; border-radius: 4px; text-decoration: none; color: white; transition: all 0.3s ease;">
                <span style="font-size: 24px;">🏷️</span>
                <div>
                    <p style="margin: 0; font-weight: bold;">Quản Lý Danh Mục</p>
                    <p style="margin: 0; font-size: 12px; opacity: 0.9;">Quản lý danh mục sản phẩm</p>
                </div>
            </a>
        </div>
    </div>
</div>

<style>
    a[href*="admin.orders"],
    a[href*="admin.products"],
    a[href*="admin.categories"] {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    a[href*="admin.orders"]:hover,
    a[href*="admin.products"]:hover,
    a[href*="admin.categories"]:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(0,0,0,0.15);
    }
</style>
@endsection
