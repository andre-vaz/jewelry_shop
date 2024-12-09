@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Product</h1>

        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" required>{{ $product->description }}</textarea>
            </div>

            <div class="form-group">
                <label for="price">Price ($)</label>
                <input type="number" class="form-control" id="price" name="price" value="{{ $product->price }}" step="0.01" required>
            </div>

            <div class="form-group">
                <label for="type_of_metal">Type of Metal</label>
                <input type="text" class="form-control" id="type_of_metal" name="type_of_metal" value="{{ $product->type_of_metal }}" required>
            </div>

            <div class="form-group">
                <label for="category_id">Category</label>
                <select class="form-control" id="category_id" name="category_id" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="image">Product Image</label>
                <input type="file" class="form-control" id="image" name="image">
                @if($product->image)
                    <img src="{{ asset('storage/'.$product->image) }}" alt="Product Image" width="100">
                @endif
            </div>

            <button type="submit" class="btn btn-warning">Update Product</button>
        </form>
    </div>
@endsection
