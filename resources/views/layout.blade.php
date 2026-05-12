<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quoc Bao Store - @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <header>
        <div class="nav-container">
            <div class="logo">Quoc Bao Store</div>
            <ul class="nav-links">
                <li><a href="{{ url('/') }}">TRANG CHỦ</a></li>
                <li><a href="{{ url('/san-pham') }}">SẢN PHẨM</a></li>
                @guest
                    <li><a href="{{ url('/dang-ky') }}">ĐĂNG KÝ</a></li>
                    <li><a href="{{ url('/dang-nhap') }}">ĐĂNG NHẬP</a></li>
                @endguest
                @auth
                    <li><a href="{{ route('dashboard') }}">TÀI KHOẢN</a></li>
                    <li>
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ĐĂNG XUẤT</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                    </li>
                @endauth
                <li><a href="{{ url('/don-hang') }}">ĐƠN HÀNG</a></li>
                <li><a href="{{ url('/cart') }}"><i class="fas fa-shopping-cart"></i> {{ session('cart') ? array_sum(array_column(session('cart'), 'quantity')) : 0 }}</a></li>
            </ul>
        </div>
    </header>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-error">
        {{ session('error') }}
    </div>
    @endif

    <div class="page-title-section">
        <h1>@yield('header_title')</h1>
    </div>

    <div class="main-container">
        @yield('content')
    </div>

    <footer>
        <div class="social-icons">
            <i class="fab fa-facebook"></i> <i class="fab fa-twitter"></i> <i class="fab fa-instagram"></i>
        </div>
        <p>Quoc Bao Store @ 2026</p>
    </footer>
</body>
</html>