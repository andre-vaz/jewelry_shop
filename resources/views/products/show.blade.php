@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <img src="{{ $product->image_url ?? 'https://via.placeholder.com/600x400' }}" class="img-fluid" alt="{{ $product->name }}">
        </div>
        <div class="col-md-6">
            <h1>{{ $product->name }}</h1>
            <p>{{ $product->description }}</p>
            <h3><strong>${{ number_format($product->price, 2) }}</strong></h3>

            <form action="{{ route('cart.add', $product) }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="quantity">Quantity</label>
                    <input type="number" name="quantity" id="quantity" class="form-control" value="1" min="1">
                </div>
                <button type="submit" class="btn btn-success">Add to Cart</button>
            </form>

            <a href="{{ route('products.catalog') }}" class="btn btn-secondary mt-3">Back to Catalog</a>
        </div>
    </div>
</div>
@endsection
