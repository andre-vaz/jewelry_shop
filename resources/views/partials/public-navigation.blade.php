<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">Our Store</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Primary Navigation Links -->
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('products.catalog') }}">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('about') }}">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contact') }}">Contact</a>
                </li>
            </ul>

            <!-- Search Bar and Secondary Links -->
            <ul class="navbar-nav align-items-center">
                <!-- Search Icon -->
                <li class="nav-item">
                    <a id="searchToggle" class="nav-link" href="#">
                        <i class="fas fa-search"></i>
                    </a>
                </li>

                <!-- Search Form -->
                <form id="searchForm" action="{{ route('products.catalog') }}" method="GET" class="d-none">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search products...">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </form>

                <!-- Cart Icon -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cart.index') }}">
                        <i class="fas fa-shopping-cart"></i> Cart
                    </a>
                </li>

                <!-- Auth Links -->
                @if (Route::has('login'))
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/dashboard') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('profile.edit') }}">Profile</a>
                        </li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-link nav-link">Logout</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">Register</a>
                            </li>
                        @endif
                    @endauth
                @endif
            </ul>
        </div>
    </div>
</nav>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchToggle = document.getElementById('searchToggle');
    const searchForm = document.getElementById('searchForm');

    if (searchToggle && searchForm) {
        searchToggle.addEventListener('click', function (e) {
            e.preventDefault();
            searchForm.classList.toggle('d-none');
            console.log("Inline script: Search form toggled");
        });
    }
});
</script>

