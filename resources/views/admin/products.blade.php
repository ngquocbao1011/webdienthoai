@extends('admin.layout')

@section('admin_content')
    @if(session('success'))
        <div style="color: green; margin-bottom: 10px;">{{ session('success') }}</div>
    @endif
    <a href="{{ route('admin.product.create') }}" style="color: blue; text-decoration: none; margin-bottom: 10px; display: inline-block;">+ thêm mới</a>

    <table style="width: 100%; border-collapse: collapse; border: 1px solid #f0a0d0;">
        <thead style="background-color: #f8d7eb;">
            <tr>
                <th>STT</th>
                <th>Tên sản phẩm</th>
                <th>Hình ảnh</th>
                <th>Giá gốc</th>
                <th>Giá khuyến mãi</th>
                <th>Tạo bởi</th>
                <th>Trạng thái</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody style="text-align: center;">
            @foreach($products as $index => $item)
            <tr style="border-bottom: 1px solid #f0a0d0;">
                <td>{{ $index + 1 }}</td>
                <td style="font-weight: bold;">{{ $item->name }}</td>
                <td>
                    @if($item->image)
                        <img src="{{ asset('storage/' . $item->image) }}" width="80" style="padding: 5px; object-fit: cover; border-radius: 4px;">
                    @else
                        <span style="color: #999;">Không có ảnh</span>
                    @endif
                </td>
                <td>{{ number_format($item->price) }} VND</td>
                <td>{{ number_format($item->price) }} VND</td>
                <td>Nguyễn Quốc Bảo</td>
                <td style="color: #333;">Active</td>
                <td>
                    <a href="{{ route('admin.product.edit', $item->id) }}" style="color: blue; text-decoration: none; display: block; margin-bottom: 5px;">Xem/Sửa</a>
                    <form action="{{ route('admin.product.lock', $item->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('POST')
                        <button type="submit" style="background-color: #c00080; color: white; border: none; padding: 5px 15px; border-radius: 4px; cursor: pointer;">
                            Khóa
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <style>
        th { padding: 10px; border: 1px solid #f0a0d0; color: #333; }
        td { padding: 10px; border: 1px solid #f0a0d0; }
    </style>
@endsection