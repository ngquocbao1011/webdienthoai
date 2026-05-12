@extends('layout')
@section('title', 'Sản phẩm')
@section('header_title', 'DANH SÁCH LINH KIỆN')

@section('content')
@php
    $categories = \App\Models\Category::all();
@endphp

@if(request()->path() === '/')
<div class="filter-section">
    <label><strong>Danh mục:</strong></label>
    <select onchange="window.location.href='?category=' + this.value">
        <option value="">Tất cả</option>
        @foreach($categories as $cat)
            <option value="{{ $cat->name }}" {{ request('category') == $cat->name ? 'selected' : '' }}>{{ $cat->name }}</option>
        @endforeach
    </select>
</div>
@endif

<div class="product-grid">
    @foreach($products as $product)
    <div class="product-card">
        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="object-fit: cover;">
        <a href="{{ url('/san-pham/' . $product->id) }}" class="product-name">{{ $product->name }}</a>
        <div class="product-meta">Đã bán: {{ $product->sold_count }}</div>
        <div class="price-sale">Giá: {{ number_format($product->price) }} VND</div>
        <div class="card-buttons">
            <form action="{{ route('cart.add', $product->id) }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn-add-cart">THÊM VÀO GIỎ</button>
            </form>
            <a href="{{ url('/san-pham/' . $product->id) }}" class="btn-view-detail" style="text-decoration: none; display: inline-block;">CHI TIẾT</a>
        </div>
    </div>
    @endforeach
</div>
@endsection