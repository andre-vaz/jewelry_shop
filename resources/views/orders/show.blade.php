@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Order #{{ $order->id }} Details</h1>
    <p>Status: {{ $order->status }}</p>
    <p>Total Price: ${{ $order->total_price }}</p>

    <h3>Products:</h3>
    <ul>
        @foreach ($order->products as $product)
        <li>{{ $product->name }} ({{ $product->pivot->quantity }} x ${{ $product->price }})</li>
        @endforeach
    </ul>

    @if ($order->status == 'pending')
    <form action="{{ route('orders.update', $order) }}" method="POST">
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
    @endif
</div>
@endsection
