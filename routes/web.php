<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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


// Default Breeze authentication routes
require __DIR__.'/auth.php';
