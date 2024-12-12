<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Product;

class CartController extends Controller
{
     // Add product to cart
     public function add(Product $product, Request $request)
     {
         $quantity = $request->input('quantity', 1);
         $cart = Session::get('cart', []);
 
         // Add or update the product in the cart
         if (isset($cart[$product->id])) {
             $cart[$product->id]['quantity'] += $quantity;
         } else {
             $cart[$product->id] = [
                 'name' => $product->name,
                 'price' => $product->price,
                 'quantity' => $quantity,
             ];
         }
 
         Session::put('cart', $cart);
 
         return redirect()->route('cart.index')->with('success', 'Product added to cart!');
     }
 
     // View the cart
     public function index()
     {
         $cart = Session::get('cart', []);
         return view('cart.index', compact('cart'));
     }
 
     // Remove product from cart
     public function remove($id)
     {
         $cart = Session::get('cart', []);
         unset($cart[$id]);
         Session::put('cart', $cart);
 
         return redirect()->route('cart.index')->with('success', 'Product removed from cart!');
     }
}
