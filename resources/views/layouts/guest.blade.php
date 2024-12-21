<!-- resources/views/layouts/guest.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    
    @vite('resources/css/app.css')


</head>
<body class="bg-light">

    <!-- Header and Navigation -->
    <header>
        @include('partials.public-navigation') <!-- Include navbar here -->
    </header>

    <!-- Main Content Area -->
    <main class="container mt-5">
        @yield('content') <!-- Page-specific content goes here -->
    </main>

    <!-- Footer -->
    <footer class="bg-light text-center text-lg-start">
    <div class="container py-4">
        <div class="row">
            <!-- Quick Links -->
            <div class="col-lg-6 col-md-6 mb-4">
                <h5>Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ url('/') }}" class="text-muted">Home</a></li>
                    <li><a href="{{ route('products.catalog') }}" class="text-muted">Products</a></li>
                    <li><a href="{{ route('about') }}" class="text-muted">About Us</a></li>
                    <li><a href="{{ route('contact') }}" class="text-muted">Contact</a></li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div class="col-lg-6 col-md-6 mb-4">
                <h5>Contact Us</h5>
                <p class="text-muted">
                    Email: support@ourstore.com<br>
                    Phone: +123-456-7890<br>
                    Address: 123 Store Street, City, Country
                </p>
                <div>
                    <a href="#" class="text-muted me-2"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="text-muted me-2"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-muted me-2"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center py-2 bg-secondary text-white">
        &copy; {{ date('Y') }} Our Store. All rights reserved.
    </div>
</footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
