@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Admin Dashboard</h1>
    <p>Welcome, {{ Auth::user()->name }}! Here you can manage the application.</p>
@endsection
