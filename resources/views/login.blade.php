@extends('layout')
@section('title', 'Đăng nhập')
@section('header_title', 'ĐĂNG NHẬP')

@section('content')
<div class="login-form">
    <form action="{{ route('login.post') }}" method="POST">
        @csrf
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <label for="password">Mật khẩu:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit">Đăng nhập</button>
    </form>
</div>
@endsection