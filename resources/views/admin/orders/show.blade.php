@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Order #{{ $order->id }} Details</h1>
    <p>User: {{ $order->user->name }}</p>
    <p>Status: {{ $order->status }}</p>
    <p>Total Price: ${{ number_format($order->total_price, 2) }}</p>

    <h3>Products:</h3>
    <ul>
        @foreach ($order->products as $product)
        <li>{{ $product->name }} ({{ $product->pivot->quantity }} x ${{ number_format($product->price, 2) }})</li>
        @endforeach
    </ul>

    <form action="{{ route('admin.orders.update', $order) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="status">Update Status:</label>
        <select name="status" id="status">
            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
        </select>
        <button type="submit" class="btn btn-primary">Update Status</button>
    </form>
</div>
@endsection
