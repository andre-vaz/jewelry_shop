<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category; 
use Illuminate\Http\Request;

class ProductController extends Controller
{
        // Display a listing of products
        public function index()
        {
            $products = Product::all();
            return view('admin.products.index', compact('products'));
        }
    
        // Show the form for creating a new product
        public function create()
        {
            $categories = Category::all(); // Fetch all categories
            return view('admin.products.create', compact('categories'));
        }
    
        // Store a newly created product in storage
        public function store(Request $request)
        {
            $request->validate([
                'name' => 'required',
                'description' => 'required',
                'price' => 'required|numeric',
                'type_of_metal' => 'required',
                'category_id' => 'required|exists:categories,id',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
    
            $product = new Product;
            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->type_of_metal = $request->type_of_metal;
            $product->category_id = $request->category_id;
    
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('products', 'public');
                $product->image = $imagePath;
            }
    
            $product->save();
    
            return redirect()->route('admin.products.index')->with('success', 'Product added successfully!');
        }
    
        // Show the form for editing the specified product
        public function edit(Product $product)
        {
            $categories = \App\Models\Category::all();
            return view('admin.products.edit', compact('product', 'categories'));
        }
    
        // Update the specified product in storage
        public function update(Request $request, Product $product)
        {
            $request->validate([
                'name' => 'required',
                'description' => 'required',
                'price' => 'required|numeric',
                'type_of_metal' => 'required',
                'category_id' => 'required|exists:categories,id',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
    
            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->type_of_metal = $request->type_of_metal;
            $product->category_id = $request->category_id;
    
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('products', 'public');
                $product->image = $imagePath;
            }
    
            $product->save();
    
            return redirect()->route('admin.products.index')->with('success', 'Product updated successfully!');
        }
    
        // Remove the specified product from storage
        public function destroy(Product $product)
        {
            $product->delete();
            return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully!');
        }

        //Catalog method
        public function catalog(Request $request)
        {
            $query = Product::query();
        
            // If there's a search term, filter the results
            if ($request->has('search') && $request->search != '') {
                $query->where('name', 'LIKE', '%' . $request->search . '%')
                      ->orWhere('description', 'LIKE', '%' . $request->search . '%');
            }
        
            $products = $query->paginate(12); // Paginate results (adjust per preference)
        
            return view('products.catalog', compact('products'));
        }
        

        //Show method
        public function show(Product $product)
        {
            return view('products.show', compact('product'));
        }


}
