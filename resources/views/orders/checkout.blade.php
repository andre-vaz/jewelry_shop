@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Checkout</h1>

    @if ($cartItems)
        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cartItems as $item)
                    <tr>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>${{ $item['price'] }}</td>
                        <td>${{ $item['price'] * $item['quantity'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Cart summary -->
        <div class="row">
            <div class="col-md-6">
                <h4>Shipping Info</h4>
                <form method="POST" action="{{ route('order.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="address" class="form-label">Shipping Address</label>
                        <input type="text" class="form-control" id="address" name="address" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Place Order</button>
                </form>
            </div>

            <div class="col-md-6">
                <h4>Total: ${{ $totalPrice }}</h4>
            </div>
        </div>
    @else
        <p>Your cart is empty.</p>
    @endif
</div>
@endsection
