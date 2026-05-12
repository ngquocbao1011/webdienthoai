@extends('layout')
@section('title', 'Đăng ký')
@section('header_title', 'ĐĂNG KÝ TÀI KHOẢN')

@section('content')
<div class="register-form">
    <form action="{{ route('register') }}" method="POST">
        @csrf
        <div>
            <label for="name">Tên:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <label for="password">Mật khẩu:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div>
            <label for="password_confirmation">Xác nhận mật khẩu:</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
        </div>
        <button type="submit">Đăng ký</button>
    </form>
</div>
@endsection