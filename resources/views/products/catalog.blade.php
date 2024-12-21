@extends(auth()->check() ? 'layouts.app' : 'layouts.guest')

@section('content')

<div class="container container-lg mt-5">
    <h1 class="mb-4">Product Catalog</h1>

    <!-- Show Search Term Feedback -->
    @if(request('search'))
        <p class="text-muted">Search results for: <strong>"{{ request('search') }}"</strong></p>
    @endif

    <div class="row">
        @forelse($products as $product)
            <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text mb-2">€{{ number_format($product->price, 2) }}</p>
                        <a href="{{ route('products.show', $product) }}" class="btn btn-outline-primary mb-2">View Details</a>
                        <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-auto">
                            @csrf
                            <button type="submit" class="btn btn-primary w-100">Add to Cart</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-muted">No products found.</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination Links -->
    <div class="mt-4">
        {{ $products->links() }}
    </div>
</div>
@endsection
