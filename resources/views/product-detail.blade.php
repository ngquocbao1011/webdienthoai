@extends('layout')
@section('title', 'Chi tiết sản phẩm')
@section('header_title', 'Sản phẩm')

@section('content')
<div class="product-detail-container" style="display: flex; gap: 40px; align-items: flex-start;">
    <div class="product-detail-image" style="flex: 1; border: 1px solid #eee; padding: 10px;">
        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="width: 100%; object-fit: cover;">
    </div>

    <div class="product-detail-info" style="flex: 1.5;">
        <h1 style="font-size: 28px; color: #333; margin-top: 0;">{{ $product->name }}</h1>
        
        <p style="color: red; font-weight: bold; font-size: 20px;">
            Giá bán: {{ number_format($product->price) }} VND
        </p>
        
        <p><strong>Đã bán:</strong> {{ $product->sold_count }}</p>
        
        <div class="product-description" style="margin: 20px 0; line-height: 1.6; color: #666;">
            <p>{{ $product->description ?? 'Thông tin mô tả linh kiện điện thoại đang được cập nhật.' }}</p>
        </div>

        <form action="{{ route('cart.add', $product->id) }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="btn-add-cart" style="background-color: #28a745; color: #fff; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; font-weight: bold;">
                THÊM VÀO GIỎ
            </button>
        </form>
    </div>
</div>
@endsection