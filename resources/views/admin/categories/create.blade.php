@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1 class="mb-4">Add New Category</h1>

        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Category Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Create Category</button>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary mt-3">Cancel</a>
        </form>
    </div>
@endsection
