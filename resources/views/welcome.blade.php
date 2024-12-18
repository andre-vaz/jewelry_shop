<!-- resources/views/welcome.blade.php -->
@extends('layouts.guest')

@section('content')
    <div class="container text-center mt-5">
        <h1 class="display-4">Welcome to Our Store</h1>
        <p class="lead">Discover the best products tailored for you!</p>
        <a href="{{ route('products.catalog') }}" class="btn btn-primary btn-lg">
            Browse Products
        </a>
    </div>
@endsection
