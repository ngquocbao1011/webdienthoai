<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class, 'index']);
Route::get('/san-pham', [ProductController::class, 'index']);

// Dashboard cho người dùng đã đăng nhập
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

// Đăng ký & Đăng nhập
Route::view('/dang-ky', 'register')->middleware('guest');
Route::post('/register', [ProductController::class, 'register'])->name('register')->middleware('guest');
Route::view('/dang-nhap', 'login')->middleware('guest')->name('login');
Route::post('/login-action', [ProductController::class, 'login'])->name('login.post')->middleware('guest');
Route::post('/logout', [ProductController::class, 'logout'])->name('logout');
// Route xem chi tiết sản phẩm
Route::get('/san-pham/{id}', [ProductController::class, 'show']);

// Các routr lien quan đén giỏ hàng
Route::patch('/update-cart', [CartController::class, 'update'])->name('cart.update');
Route::delete('/remove-from-cart', [CartController::class, 'remove'])->name('cart.remove');

// Route xử lý khi bấm nút "Tiến hành đặt hàng"
Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout');
// Route hiển thị trang "Đơn hàng"
Route::get('/don-hang', [CartController::class, 'orderHistory'])->name('orders.index')->middleware('auth');

// Route hiển thị trang giỏ hàng (Giao diện bảng bạn đã làm)
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
// Route xử lý khi người dùng nhấn nút "THÊM VÀO GIỎ"
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
// Trang dashboard
Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard.alt');

// Trang danh sách sản phẩm (như hình)
Route::get('/san-pham', [AdminController::class, 'listProducts'])->name('admin.products');
    
 // Các route chức năng khác
 Route::get('/them-moi', [AdminController::class, 'createProduct'])->name('admin.product.create');
 Route::post('/luu-san-pham', [AdminController::class, 'storeProduct'])->name('admin.product.store');
 Route::get('/sua/{id}', [AdminController::class, 'editProduct'])->name('admin.product.edit');
 Route::put('/cap-nhat/{id}', [AdminController::class, 'updateProduct'])->name('admin.product.update');
 Route::post('/khoa/{id}', [AdminController::class, 'lockProduct'])->name('admin.product.lock');
 Route::get('/don-hang', [AdminController::class, 'listOrders'])->name('admin.orders');
 Route::get('/don-hang/{id}', [AdminController::class, 'orderDetails'])->name('admin.order.details');
 Route::post('/don-hang/{id}/cap-nhat-trang-thai', [AdminController::class, 'updateOrderStatus'])->name('admin.order.updateStatus');
 });

 // quan ly danh muc
 Route::get('/admin/danh-muc', [AdminController::class, 'listCategories'])->name('admin.categories');
 Route::get('/admin/them-danh-muc', [AdminController::class, 'createCategory'])->name('admin.category.create');
 Route::post('/admin/luu-danh-muc', [AdminController::class, 'storeCategory'])->name('admin.category.store');
 Route::get('/admin/sua-danh-muc/{id}', [AdminController::class, 'editCategory'])->name('admin.category.edit');
 Route::put('/admin/cap-nhat-danh-muc/{id}', [AdminController::class, 'updateCategory'])->name('admin.category.update');
 Route::delete('/admin/xoa-danh-muc/{id}', [AdminController::class, 'deleteCategory'])->name('admin.category.delete');
 // quan ly don hang
 Route::get('/admin/don-hang', [AdminController::class, 'listOrders'])->name('admin.orders');

 // Route hiển thị form thêm mới
 Route::get('/admin/san-pham/them-moi', [AdminController::class, 'createProduct'])->name('admin.product.create');
 // Route xử lý lưu sản phẩm vào database
 Route::post('/admin/san-pham/store', [AdminController::class, 'storeProduct'])->name('admin.product.store');

 // Route hiển thị form thêm danh mục
Route::get('/admin/danh-muc/them-moi', [AdminController::class, 'createCategory'])->name('admin.category.create');

// Route xử lý lưu danh mục
Route::post('/admin/danh-muc/store', [AdminController::class, 'storeCategory'])->name('admin.category.store');