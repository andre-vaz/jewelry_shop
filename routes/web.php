<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

// Resource route for products
Route::resource('products', ProductController::class);
