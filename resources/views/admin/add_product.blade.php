@extends('admin.layout')

@section('admin_content')
<div style="max-width: 800px; margin: 0 auto; background: #fff; padding: 20px;">
    <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div style="margin-bottom: 15px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">Tên sản phẩm</label>
            <input type="text" name="name" placeholder="Tên sản phẩm.." style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">Giá</label>
            <input type="number" name="price" placeholder="Giá.." style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">Hình ảnh</label>
            <div style="border: 1px solid #ddd; padding: 10px; border-radius: 4px; background: #f9f9f9;">
                <input type="file" name="image">
            </div>
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">Loại sản phẩm</label>
            <select name="category" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
                @foreach($categories as $cat)
                    <option value="{{ $cat->name }}">{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">Mô tả</label>
            <textarea name="description" style="width: 100%; height: 150px; padding: 10px; border: 1px solid #ddd; border-radius: 4px;"></textarea>
        </div>

        <div style="text-align: center;">
            <button type="submit" style="background: #c00080; color: white; border: none; padding: 10px 30px; border-radius: 4px; cursor: pointer; font-weight: bold;">
                Lưu sản phẩm
            </button>
        </div>
    </form>
</div>
@endsection