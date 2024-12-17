<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\NotificationController; // Added for notifications

// Home route
Route::get('/', function () {
    return view('welcome'); // Updated to point to the new welcome.blade.php
})->name('home');

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
Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
});

// Regular User Dashboard route (protected with 'auth' and 'verified' middlewares)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Order routes for authenticated users
Route::middleware('auth')->group(function () {
    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('orders', [OrderController::class, 'store'])->name('orders.store');
    Route::put('orders/{order}', [OrderController::class, 'update'])->name('orders.update');
    Route::delete('orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');
});

// Product Catalog Route (public-facing)
Route::get('/products', [ProductController::class, 'catalog'])->name('products.catalog');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

// Cart routes (protected with 'auth' middleware)
Route::middleware('auth')->group(function () {
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
});

// Checkout route
Route::middleware('auth')->group(function () {
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::post('/order', [OrderController::class, 'store'])->name('order.store');
    Route::post('/place-order', [OrderController::class, 'placeOrder'])->name('orders.place');
});

// Admin routes for managing orders
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/orders', [OrderController::class, 'adminIndex'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'adminShow'])->name('orders.show');
    Route::put('/orders/{order}', [OrderController::class, 'adminUpdate'])->name('orders.update');
    Route::delete('/orders/{order}', [OrderController::class, 'adminDestroy'])->name('orders.destroy');
});

// Mark notifications as read
Route::put('/notifications/{notification}', [NotificationController::class, 'markAsRead'])->name('markNotificationAsRead');

// Default Breeze authentication routes
require __DIR__.'/auth.php';
