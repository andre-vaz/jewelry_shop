<!-- resources/views/layouts/guest.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="bg-gray-100">

    <!-- Header and Navigation -->
    <header class="bg-white shadow">
        <div class="container mx-auto py-4">
            @include('partials.public-navigation')
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="container mx-auto mt-6">
        {{ $slot }} <!-- This is where individual page content will be injected -->
    </main>

    <!-- Footer -->
    <footer class="bg-white shadow mt-12 py-4">
        <div class="container mx-auto text-center text-gray-600">
            <p>&copy; {{ date('Y') }} My Laravel App. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>
