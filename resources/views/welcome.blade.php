@extends('layouts.guest')

@section('content')
<div class="container my-5">
    <!-- Carousel Section -->
    <div id="homeCarousel" class="carousel slide mb-5" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach($carouselImages as $image)
                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                    <img src="{{ asset('storage/' . $image->image_path) }}" class="d-block w-100" alt="{{ $image->title }}">
                    <div class="carousel-caption d-none d-md-block">
                        <h3>{{ $image->title }}</h3>
                        <p>{{ $image->description }}</p>
                        <a href="{{ route('products.catalog') }}" class="btn btn-primary">Browse Collection</a>
                    </div>
                </div>
            @endforeach
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#homeCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#homeCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Featured Products Section -->
    <h2 class="text-center mb-4">Featured Products</h2>
    <div class="row">
        @foreach($featuredProducts as $product)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">${{ number_format($product->price, 2) }}</p>
                        <a href="{{ route('products.show', $product) }}" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
