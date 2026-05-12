@extends('admin.layout')

@section('admin_content')
<div style="max-width: 900px; margin: 40px auto; padding: 20px;">
    @if(session('success'))
        <div style="color: green; margin-bottom: 10px;">{{ session('success') }}</div>
    @endif
    <a href="{{ route('admin.categories') }}" style="color: blue; text-decoration: none; margin-bottom: 20px; display: inline-block;">← Quay lại danh sách</a>
    <form action="{{ route('admin.category.store') }}" method="POST">
        @csrf
        
        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: bold; margin-bottom: 10px; font-size: 16px;">Tên danh mục</label>
            <input type="text" name="name" placeholder="Tên danh mục.." required
                style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;">
        </div>

        <button type="submit" style="width: 100%; background: #c00080; color: white; border: none; padding: 12px; font-size: 16px; cursor: pointer; border-radius: 4px;">
            Lưu
        </button>
    </form>

    <div style="text-align: center; margin-top: 100px; color: #888; font-size: 13px;">
    
    </div>
</div>
@endsection