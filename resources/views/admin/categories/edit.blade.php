@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1 class="mb-4">Edit Category</h1>

        <form action="{{ route('admin.categories.update', $category) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Category Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $category->name }}" required>
            </div>

            <button type="submit" class="btn btn-success mt-3">Update Category</button>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary mt-3">Cancel</a>
        </form>
    </div>
@endsection
