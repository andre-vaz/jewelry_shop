<?php

namespace App\Http\Controllers\Admin;

use App\Models\CarouselImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CarouselImageController extends Controller
{
    public function index()
    {
        $carouselImages = CarouselImage::all();
        return view('admin.carousel.index', compact('carouselImages'));
    }

    public function create()
    {
        return view('admin.carousel.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'description' => 'nullable|string',
        ]);

        $imagePath = $request->file('image')->store('carousel_images', 'public');

        CarouselImage::create([
            'title' => $request->title,
            'image_path' => $imagePath,
            'description' => $request->description,
            'is_active' => true,
        ]);

        return redirect()->route('admin.carousel.index')->with('success', 'Carousel image added successfully!');
    }

    public function destroy($id)
    {
        $carouselImage = CarouselImage::findOrFail($id);
        $carouselImage->delete();

        return redirect()->route('admin.carousel.index')->with('success', 'Carousel image deleted successfully!');
    }

    public function toggleStatus(CarouselImage $carouselImage)
    {
        $carouselImage->is_active = !$carouselImage->is_active;
        $carouselImage->save();

        return redirect()->route('admin.carousel.index')->with('success', 'Carousel image status updated successfully!');
    }

}
