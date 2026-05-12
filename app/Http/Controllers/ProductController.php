<?php
namespace App\Http\Controllers;

use App\Models\Product; // Đảm bảo đã import Model Product
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProductController extends Controller
{
    // 1. Hiển thị danh sách & Lọc iPhone/Samsung
    public function index(Request $request) {
        $query = Product::query();
        
        // Kiểm tra nếu có chọn danh mục iPhone hoặc Samsung
        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }
        
        $products = $query->get();
        return view('products', compact('products'));
    }

    // 2. Xử lý Đăng ký
    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Đăng ký thành công!');
    }

    // 3. Xử lý Đăng nhập
    public function login(Request $request) {
        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            // Nếu là admin, chuyển đến trang admin
            if ($user->role === 'admin') {
                return redirect()->route('admin.products')->with('success', 'Đăng nhập thành công!');
            }
            // Nếu có intended và là checkout, redirect đến cart
            $intended = session('url.intended');
            if ($intended && str_contains($intended, '/checkout')) {
                return redirect()->route('cart.index')->with('success', 'Đăng nhập thành công! Giỏ hàng của bạn vẫn còn.');
            }
            // Ngược lại, chuyển đến dashboard
            return redirect()->route('dashboard')->with('success', 'Đăng nhập thành công!'); 
        }
        
        return back()->withErrors(['msg' => 'Sai tài khoản hoặc mật khẩu']);
    }

    // 4. Xử lý Đăng xuất
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate(); // Xóa session để bảo mật
        $request->session()->regenerateToken(); // Tạo lại token mới
        return redirect('/');
    }

    // 4. Xem chi tiết sản phẩm
    public function show($id) {
        // Tìm sản phẩm, nếu không thấy sẽ hiện trang 404
        $product = Product::findOrFail($id); 
        
        return view('product-detail', compact('product'));
    }
}