<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;      // Thêm Model Order
use App\Models\OrderItem;  // Thêm Model OrderItem
use Illuminate\Support\Facades\Auth; // Để lấy ID người dùng đăng nhập

class CartController extends Controller
{
    public function index()
    {
        return view('cart');
    }

    public function add(Request $request, $id)
    {
        $product = Product::find($id);
        if(!$product) {
            abort(404);
        }

        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image
            ];
        }

        session()->put('cart', $cart);
        return redirect()->route('cart.index')->with('success', 'Sản phẩm đã được thêm vào giỏ hàng!');
    }

    public function update(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Giỏ hàng đã được cập nhật!');
        }
    }

    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Sản phẩm đã được xóa khỏi giỏ hàng!');
        }
    }

    /**
     * Xử lý thanh toán và lưu đơn hàng
     */
    public function checkout(Request $request)
    {
        // Kiểm tra đăng nhập
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để đặt hàng.');
        }

        $cart = session()->get('cart');

        // Kiểm tra nếu giỏ hàng trống hoặc người dùng chưa nhập địa chỉ
        if (!$cart) {
            return redirect()->back()->with('error', 'Giỏ hàng của bạn đang trống!');
        }

        // 1. Tạo đơn hàng mới trong bảng orders
        $order = Order::create([
            'user_id' => Auth::id(),
            'customer_name' => $request->customer_name ?? Auth::user()->name,
            'phone' => $request->phone,
            'total_price' => array_sum(array_map(function($item) {
                return $item['price'] * $item['quantity'];
            }, $cart)),
            'status' => 'Processing',
            'address' => $request->address,
        ]);

        // 2. Lưu từng sản phẩm từ giỏ hàng vào bảng order_items
        foreach ($cart as $id => $details) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'quantity' => $details['quantity'],
                'price' => $details['price'],
            ]);
        }

        // 3. Xóa giỏ hàng sau khi đặt thành công
        session()->forget('cart');

        // 4. Chuyển hướng về trang chủ
        return redirect('/')->with('success', 'Đặt hàng thành công!');
    }

    /**
     * Hiển thị danh sách đơn hàng đã mua
     */
    public function orderHistory()
    {
        $orders = Order::where('user_id', Auth::id())->latest()->get();
        return view('orders', compact('orders'));
    }
}