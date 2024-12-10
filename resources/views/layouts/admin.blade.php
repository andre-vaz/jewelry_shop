<!-- resources/views/layouts/admin.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation') <!-- Include navigation bar (if you want common nav for admin) -->

        <div class="flex">
            <!-- Sidebar for Admin -->
            <div class="w-1/4 bg-gray-800 text-white">
                <nav class="py-4">
                    <ul>
                        <li><a href="{{ route('admin.dashboard') }}" class="block px-4 py-2">Dashboard</a></li>
                        <li><a href="{{ route('admin.products.index') }}" class="block px-4 py-2">Products</a></li>
                        <li><a href="{{ route('admin.categories.index') }}" class="block px-4 py-2">Categories</a></li>
                        <li><a href="{{ route('profile.edit') }}" class="block px-4 py-2">Profile</a></li>
                    </ul>
                </nav>
            </div>

            <!-- Main Content -->
            <div class="flex-1 p-8">
                <main>
                    @yield('content')
                </main>
            </div>
        </div>
    </div>
</body>
</html>
