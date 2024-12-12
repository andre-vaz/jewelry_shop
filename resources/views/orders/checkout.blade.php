@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Checkout</h1>

    @if ($cartItems && count($cartItems) > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cartItems as $index => $item)
                    <tr>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>${{ number_format($item['price'], 2) }}</td>
                        <td>${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Cart summary and shipping info -->
        <div class="row mt-4">
            <div class="col-md-6">
                <h4>Shipping Info</h4>
                <form method="POST" action="{{ route('order.store') }}">
                    @csrf

                    <!-- Shipping Address -->
                    <div class="mb-3">
                        <label for="address" class="form-label">Shipping Address</label>
                        <input type="text" class="form-control" id="address" name="address" required>
                    </div>

                    <!-- Pass Product IDs and Quantities as Hidden Inputs -->
                    @foreach ($cartItems as $index => $item)
                        <input type="hidden" name="product_ids[]" value="{{ $item['id'] }}">
                        <input type="hidden" name="quantities[]" value="{{ $item['quantity'] }}">
                    @endforeach

                    <button type="submit" class="btn btn-success btn-lg mt-3">Place Order</button>
                </form>
            </div>

            <!-- Total Price Summary -->
            <div class="col-md-6 text-end">
                <h4 class="fw-bold">Total: ${{ number_format($totalPrice, 2) }}</h4>
            </div>
        </div>
    @else
        <div class="alert alert-warning">
            <p>Your cart is empty. <a href="{{ route('products.index') }}">Continue Shopping</a></p>
        </div>
    @endif
</div>
@endsection
