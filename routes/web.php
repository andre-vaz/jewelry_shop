<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;


// Home route
Route::get('/', function () {
    return view('welcome');
});

// Dashboard route (protected with 'auth' and 'verified' middlewares)
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified', 'admin'])->name('admin.dashboard');

// Profile routes (protected with 'auth' middleware)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Product management routes (protected with 'auth','verified', and 'admin' middleware)
Route::middleware('auth', 'verified', 'admin')->prefix('admin')->name('admin.')->group(function () {
        Route::resource('products', ProductController::class);
});

// Regular User Dashboard route (protected with 'auth' and 'verified' middlewares)
Route::get('/dashboard', function () {
    return view('dashboard'); // Regular user's dashboard view
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Product routes
    Route::resource('products', ProductController::class);

    // Category routes
    Route::resource('categories', CategoryController::class);
});

Route::middleware('auth')->group(function () {
    // Order management routes
    Route::get('orders', [OrderController::class, 'index'])->name('orders.index'); // Show all orders
    Route::get('orders/{order}', [OrderController::class, 'show'])->name('orders.show'); // Show order details
    Route::post('orders', [OrderController::class, 'store'])->name('orders.store'); // Place an order
    Route::put('orders/{order}', [OrderController::class, 'update'])->name('orders.update'); // Update order status
    Route::delete('orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy'); // Delete an order
});

// Product Catalog Route (public-facing)
Route::get('/products', [ProductController::class, 'catalog'])->name('products.catalog');

Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

// Cart routes
Route::middleware('auth')->group(function () {
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
});

//Check out route
Route::middleware(['auth'])->group(function () {
    // Checkout page route
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    // Order store route (to handle the POST request for placing an order)
    Route::post('/order', [OrderController::class, 'store'])->name('order.store');
});


// Default Breeze authentication routes
require __DIR__.'/auth.php';
