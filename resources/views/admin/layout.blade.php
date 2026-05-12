@php
    use Illuminate\Support\Facades\Request;
@endphp
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Admin - StoreNow</title>
    <style>
        body { margin: 0; font-family: Arial, sans-serif; }
        /* Header chính màu hồng đậm */
        .admin-header {
            background-color: #c00080; 
            color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .admin-nav a {
            background: none;
            border: none;
            color: white;
            padding: 10px 15px;
            cursor: pointer;
            font-weight: bold;
            text-decoration: none;
            display: inline-block;
        }
        .admin-nav .active {
            background-color: white;
            color: #c00080;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <header class="admin-header">
        <h1 style="margin: 0;"><a href="{{ route('admin.dashboard') }}" style="color: white; text-decoration: none; cursor: pointer;">ADMIN</a></h1>
        <div class="admin-nav">
            <a href="{{ route('admin.dashboard') }}" class="{{ Request::routeIs('admin.dashboard*') ? 'active' : '' }}">BẢNG ĐIỀU KHIỂN</a>
            <a href="{{ route('admin.products') }}" class="{{ Request::routeIs('admin.products') ? 'active' : '' }}">SẢN PHẨM</a>
            <a href="{{ route('admin.categories') }}" class="{{ Request::routeIs('admin.categories') ? 'active' : '' }}">DANH MỤC</a>
            <a href="{{ route('admin.orders') }}" class="{{ Request::routeIs('admin.orders') ? 'active' : '' }}">ĐƠN HÀNG</a>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ĐĂNG XUẤT</a>
        </div>
    </header>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <main style="padding: 20px;">
        @yield('admin_content')
    </main>
</body>
</html>