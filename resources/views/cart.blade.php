@extends('layout')
@section('content')
<div class="cart-container" style="display: flex; gap: 20px; padding: 20px;">
    <table style="flex: 3; border: 1px solid #ddd; text-align: center; border-collapse: collapse;">
        <thead style="background: #f4f4f4;">
            <tr>
                <th>STT</th>
                <th>Tên sản phẩm</th>
                <th>Hình ảnh</th>
                <th>Đơn giá</th>
                <th>Số lượng</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; $totalQuantity = 0; @endphp
            @if(session('cart'))
                @foreach(session('cart') as $id => $details)
                    @php 
                        $total += $details['price'] * $details['quantity'];
                        $totalQuantity += $details['quantity'];
                    @endphp
                    <tr data-id="{{ $id }}">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $details['name'] }}</td>
                        <td><img src="{{ asset('images/'.$details['image']) }}" width="80"></td>
                        <td>{{ number_format($details['price']) }}VND</td>
                        <td>
                            <input type="number" value="{{ $details['quantity'] }}" class="quantity update-cart" min="1" style="width: 50px;">
                        </td>
                        <td>
                            <button class="remove-from-cart" style="color: blue; border: none; background: none; cursor: pointer;">Xóa</button>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>

    <div class="order-summary" style="flex: 1; border: 1px solid #ddd; padding: 15px; background: #fafafa;">
        <form action="{{ route('checkout') }}" method="POST">
            @csrf
            <h3>Thông tin đơn đặt hàng</h3>

            <label style="display: block; margin-bottom: 10px;">
                <strong>Người đặt hàng:</strong>
                <input type="text" name="customer_name" value="{{ Auth::user()->name ?? '' }}" required
                       style="width: 100%; padding: 8px; border: 1px solid #ccc; margin-top: 5px; box-sizing: border-box;">
            </label>

            <label style="display: block; margin-bottom: 10px;">
                <strong>Số điện thoại:</strong>
                <input type="tel" name="phone" placeholder="Nhập số điện thoại..." required
                       style="width: 100%; padding: 8px; border: 1px solid #ccc; margin-top: 5px; box-sizing: border-box;">
            </label>

            <p>Số lượng: <strong>{{ $totalQuantity }}</strong></p>
            <p>Tổng tiền: <strong style="color: red;">{{ number_format($total) }}VND</strong></p>

            <p style="margin-bottom: 5px;"><strong>Địa chỉ nhận hàng:</strong></p>
            <textarea name="address" required style="width: 100%; height: 80px; margin-bottom: 15px; border: 1px solid #ccc; padding: 5px; box-sizing: border-box;" placeholder="Nhập địa chỉ giao hàng..."></textarea>

            <button type="submit" style="background: green; color: white; width: 100%; padding: 10px; border: none; cursor: pointer; font-weight: bold;">
                Tiến hành đặt hàng
            </button>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
    // Giữ nguyên các đoạn Script cập nhật và xóa của bạn vì chúng đã đúng logic AJAX
    $(".update-cart").change(function (e) {
        e.preventDefault();
        var ele = $(this);
        $.ajax({
            url: "{{ route('cart.update') }}",
            method: "patch",
            data: {
                _token: '{{ csrf_token() }}', 
                id: ele.parents("tr").attr("data-id"), 
                quantity: ele.parents("tr").find(".quantity").val()
            },
            success: function (response) {
               window.location.reload();
            }
        });
    });

    $(".remove-from-cart").click(function (e) {
        e.preventDefault();
        var ele = $(this);
        if(confirm("Bạn có muốn xóa sản phẩm này?")) {
            $.ajax({
                url: "{{ route('cart.remove') }}",
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}', 
                    id: ele.parents("tr").attr("data-id")
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        }
    });
</script>
@endsection