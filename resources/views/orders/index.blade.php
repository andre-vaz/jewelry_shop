@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Your Orders</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Status</th>
                <th>Total Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->status }}</td>
                <td>${{ $order->total_price }}</td>
                <td>
                    <a href="{{ route('orders.show', $order) }}" class="btn btn-info">View</a>
                    @if ($order->status == 'pending')
                    <form action="{{ route('orders.destroy', $order) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Cancel</button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
