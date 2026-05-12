@extends('admin.layout')

@section('admin_content')
    @if(session('success'))
        <div style="color: green; margin-bottom: 10px;">{{ session('success') }}</div>
    @endif
    <div style="margin-bottom: 10px;">
        <a href="{{ route('admin.category.create') }}" style="color: blue; text-decoration: none;">+ Thêm mới</a>
    </div>

    <table style="width: 100%; border-collapse: collapse; border: 1px solid #f0a0d0; text-align: center;">
        <thead style="background-color: #f8d7eb;">
            <tr>
                <th style="padding: 10px; border: 1px solid #f0a0d0;">STT</th>
                <th style="padding: 10px; border: 1px solid #f0a0d0;">Tên danh mục</th>
                <th style="padding: 10px; border: 1px solid #f0a0d0;">Trạng thái</th>
                <th style="padding: 10px; border: 1px solid #f0a0d0;">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $index => $cat)
            <tr style="border-bottom: 1px solid #f0a0d0;">
                <td style="padding: 15px; border: 1px solid #f0a0d0;">{{ $index + 1 }}</td>
                <td style="padding: 15px; border: 1px solid #f0a0d0;">{{ $cat->name }}</td>
                <td style="padding: 15px; border: 1px solid #f0a0d0;">{{ $cat->status }}</td>
                <td style="padding: 10px; border: 1px solid #f0a0d0;">
                    <a href="{{ route('admin.category.edit', $cat->id) }}" style="color: blue; text-decoration: none; display: block; margin-bottom: 5px;">Xem/Sửa</a>
                    <form action="{{ route('admin.category.delete', $cat->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Bạn có chắc muốn xóa danh mục này?')" style="background-color: #c00080; color: white; border: none; padding: 8px 25px; border-radius: 4px; cursor: pointer; width: 80%;">
                            Xóa
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div style="text-align: center; margin-top: 15px; color: blue;">
        « 1 »
    </div>

    <div style="text-align: center; margin-top: 50px; color: #888; font-size: 12px;">
    
    </div>
@endsection