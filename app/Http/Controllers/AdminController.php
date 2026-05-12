<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Tổng doanh thu
        $totalRevenue = Order::sum('total_price');

        // Tổng số đơn hàng
        $totalOrders = Order::count();

        // Doanh thu theo tháng (12 tháng gần đây)
        $revenueByMonth = Order::selectRaw('MONTH(created_at) as month, YEAR(created_at) as year, SUM(total_price) as total')
            ->where('created_at', '>=', now()->subMonths(12))
            ->groupBy(DB::raw('YEAR(created_at), MONTH(created_at)'))
            ->orderBy(DB::raw('YEAR(created_at), MONTH(created_at)'), 'asc')
            ->get()
            ->map(function($item) {
                $item->month_name = $this->getMonthName($item->month);
                return $item;
            });

        // Số đơn hàng theo trạng thái
        $ordersByStatus = Order::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->get();

        // Top 5 sản phẩm bán chạy
        $topProducts = \App\Models\OrderItem::select('product_id', DB::raw('SUM(quantity) as total_quantity'))
            ->groupBy('product_id')
            ->orderBy('total_quantity', 'desc')
            ->limit(5)
            ->with('product')
            ->get();

        return view('admin.dashboard', compact('totalRevenue', 'totalOrders', 'revenueByMonth', 'ordersByStatus', 'topProducts'));
    }

    private function getMonthName($month)
    {
        $months = [
            1 => 'Tháng 1', 2 => 'Tháng 2', 3 => 'Tháng 3', 4 => 'Tháng 4',
            5 => 'Tháng 5', 6 => 'Tháng 6', 7 => 'Tháng 7', 8 => 'Tháng 8',
            9 => 'Tháng 9', 10 => 'Tháng 10', 11 => 'Tháng 11', 12 => 'Tháng 12'
        ];
        return $months[$month] ?? 'N/A';
    }

    public function listProducts()
    {
        // Lấy toàn bộ sản phẩm từ database
        $products = Product::all();
        return view('admin.products', compact('products'));
    }

    public function listCategories()
{
    $categories = \App\Models\Category::all();
    return view('admin.categories', compact('categories'));
}

public function listOrders(Request $request)
{
    // Lấy tất cả đơn hàng, sắp xếp mới nhất lên đầu
    $query = \App\Models\Order::with('user');

    // Lọc theo trạng thái nếu có
    if ($request->has('status') && $request->status != '') {
        $query->where('status', $request->status);
    }

    $orders = $query->latest()->get();

    // Tự động cập nhật trạng thái cho tất cả đơn hàng
    foreach ($orders as $order) {
        $order->autoUpdateStatus();
    }

    return view('admin.orders', compact('orders'));
}

public function orderDetails($id)
{
    // Lấy chi tiết đơn hàng và các sản phẩm trong đó
    $order = \App\Models\Order::with('items.product', 'user')->findOrFail($id);

    // Tự động cập nhật trạng thái
    $order->autoUpdateStatus();

    return view('admin.order_details', compact('order'));
}

public function updateOrderStatus(Request $request, $id)
{
    // Cập nhật trạng thái đơn hàng
    $order = \App\Models\Order::findOrFail($id);
    $order->update(['status' => $request->status]);
    return redirect()->route('admin.orders')->with('success', 'Cập nhật trạng thái đơn hàng thành công!');
}
public function createProduct() {
    $categories = \App\Models\Category::all(); // Lấy danh mục để đưa vào dropdown
    return view('admin.add_product', compact('categories'));
}

public function storeProduct(Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric',
        'category' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'description' => 'nullable|string',
    ]);

    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('products', 'public');
    }

    Product::create([
        'name' => $request->name,
        'price' => $request->price,
        'category' => $request->category,
        'image' => $imagePath,
        'description' => $request->description,
        'sold_count' => 0,
    ]);

    return redirect()->route('admin.products')->with('success', 'Thêm sản phẩm thành công!');
}

public function editProduct($id) {
    $product = Product::findOrFail($id);
    $categories = \App\Models\Category::all();
    return view('admin.edit_product', compact('product', 'categories'));
}

public function updateProduct(Request $request, $id) {
    $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric',
        'category' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'description' => 'nullable|string',
    ]);

    $product = Product::findOrFail($id);

    $imagePath = $product->image;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('products', 'public');
    }

    $product->update([
        'name' => $request->name,
        'price' => $request->price,
        'category' => $request->category,
        'image' => $imagePath,
        'description' => $request->description,
    ]);

    return redirect()->route('admin.products')->with('success', 'Cập nhật sản phẩm thành công!');
}

public function lockProduct($id) {
    $product = Product::findOrFail($id);
    $product->update(['status' => $product->status === 'Active' ? 'Locked' : 'Active']);
    return redirect()->route('admin.products')->with('success', 'Thay đổi trạng thái sản phẩm thành công!');
}
public function createCategory() {
    return view('admin.add_category');
}

public function storeCategory(Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
    ]);

    \App\Models\Category::create([
        'name' => $request->name,
        'status' => 'Active' // Mặc định trạng thái là Active
    ]);

    return redirect()->route('admin.categories')->with('success', 'Thêm danh mục thành công!');
}

public function editCategory($id) {
    $category = \App\Models\Category::findOrFail($id);
    return view('admin.edit_category', compact('category'));
}

public function updateCategory(Request $request, $id) {
    $request->validate([
        'name' => 'required|string|max:255',
    ]);

    $category = \App\Models\Category::findOrFail($id);
    $category->update([
        'name' => $request->name,
    ]);

    return redirect()->route('admin.categories')->with('success', 'Cập nhật danh mục thành công!');
}

public function deleteCategory($id) {
    $category = \App\Models\Category::findOrFail($id);
    $category->delete();

    return redirect()->route('admin.categories')->with('success', 'Xóa danh mục thành công!');
}

}