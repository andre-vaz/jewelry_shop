@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="my-4">Manage Carousel Images</h1>

    <a href="{{ route('admin.carousel.create') }}" class="btn btn-primary mb-4">Add New Image</a>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($carouselImages as $image)
                <tr>
                    <td>{{ $image->title }}</td>
                    <td>{{ $image->description }}</td>
                    <td><img src="{{ asset('storage/' . $image->image_path) }}" width="100" alt="{{ $image->title }}"></td>
                    <td>
                        <form action="{{ route('admin.carousel.destroy', $image->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
