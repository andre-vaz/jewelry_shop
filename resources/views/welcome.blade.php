<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Our Store</title>
    <!-- Add Tailwind CSS CDN for styling -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 h-screen">

    <nav class="bg-white shadow-md p-4">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ url('/') }}" class="text-xl font-bold text-blue-600">Our Store</a>

            <div>
                @if (Route::has('login'))
                    <div class="space-x-4">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-gray-700 hover:text-blue-600">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600">Log in</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="text-gray-700 hover:text-blue-600">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </nav>

    <div class="flex items-center justify-center h-3/4">
        <div class="text-center">
            <h1 class="text-5xl font-bold mb-6 text-gray-800">Welcome to Our Store</h1>
            <p class="text-lg text-gray-600 mb-8">Discover the best products tailored for you!</p>
            <a href="{{ route('products.catalog') }}" class="bg-blue-600 text-white px-6 py-3 rounded-md text-lg hover:bg-blue-700">
                Browse Products
            </a>
        </div>
    </div>

    <footer class="text-center p-4 bg-white shadow-md">
        <p class="text-gray-600">&copy; {{ date('Y') }} Our Store. All rights reserved.</p>
    </footer>

</body>
</html>
