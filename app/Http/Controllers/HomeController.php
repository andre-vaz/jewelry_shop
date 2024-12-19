<?php

namespace App\Http\Controllers;

use App\Models\CarouselImage;
use App\Models\Product;


class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::where('is_featured', true)->take(6)->get();
        $carouselImages = CarouselImage::where('is_active', true)->get();
    
        return view('welcome', compact('featuredProducts', 'carouselImages'));
    }
    
}
