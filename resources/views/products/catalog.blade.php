@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Product Catalog</h1>
    <div class="row">
        @foreach ($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="{{ $product->image_url ?? 'https://via.placeholder.com/300x200' }}" class="card-img-top" alt="{{ $product->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                        <p class="card-text"><strong>${{ number_format($product->price, 2) }}</strong></p>
                        <a href="{{ route('products.show', $product) }}" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
