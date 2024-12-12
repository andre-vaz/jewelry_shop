<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
     // Show all orders for the authenticated user (or admin if required)
     public function index()
     {
         $orders = Auth::user()->orders()->with('products')->get(); // Get user's orders
         return view('orders.index', compact('orders'));
     }
 
     // Show a specific order (order details)
     public function show($id)
     {
         $order = Order::with('products')->findOrFail($id);
         return view('orders.show', compact('order'));
     }
 
     // Place an order (Add products to cart and place an order)
     public function store(Request $request)
    {
        $validated = $request->validate([
            'product_ids' => 'required|array',
            'product_ids.*' => 'exists:products,id',
            'quantities' => 'required|array',
            'quantities.*' => 'integer|min:1',
            'address' => 'required|string',
        ]);

        // Create an order and associate products with it
        $order = Order::create([
            'user_id' => Auth::id(),
            'total_price' => $this->calculateTotalPrice($validated['product_ids'], $validated['quantities']),
            'status' => 'pending',
        ]);

        // Prepare product-quantity pairs for attaching
        $productData = [];
        foreach ($validated['product_ids'] as $index => $productId) {
            $productData[$productId] = ['quantity' => $validated['quantities'][$index]];
        }

        // Attach products to the order with their respective quantities
        $order->products()->attach($productData);

        // Clear the cart after the order is placed successfully
        session()->forget('cart');

        return redirect()->route('orders.show', $order->id)
            ->with('success', 'Order placed successfully!');
    }

 
     // Update an order (e.g., update status)
     public function update(Request $request, $id)
     {
         $order = Order::findOrFail($id);
 
         // Only allow admin or the user who created the order to update it
         if ($order->user_id != Auth::id() && !Auth::user()->is_admin) {
             return redirect()->route('orders.index')->with('error', 'Unauthorized action');
         }
 
         $order->update([
             'status' => $request->status,
         ]);
 
         return redirect()->route('orders.index')->with('success', 'Order status updated successfully!');
     }
 
     // Delete an order
     public function destroy($id)
     {
         $order = Order::findOrFail($id);
 
         // Only allow admin or the user who created the order to delete it
         if ($order->user_id != Auth::id() && !Auth::user()->is_admin) {
             return redirect()->route('orders.index')->with('error', 'Unauthorized action');
         }
 
         $order->delete();
 
         return redirect()->route('orders.index')->with('success', 'Order deleted successfully!');
     }
 
     // Helper function to calculate the total price of an order
     private function calculateTotalPrice($productIds, $quantities)
     {
         $total = 0;
 
         foreach ($productIds as $index => $productId) {
             $product = Product::findOrFail($productId);
             $total += $product->price * $quantities[$index];
         }
 
         return $total;
     }

     //checkout method
     public function checkout()
     {
         // Assuming you are storing cart items in session
         $cartItems = session()->get('cart', []); // Get cart from session (or database if you prefer)
         $totalPrice = array_sum(array_map(function ($item) {
             return $item['price'] * $item['quantity'];
         }, $cartItems)); // Calculate the total price of the cart items
     
         return view('orders.checkout', compact('cartItems', 'totalPrice')); // Return the view inside the 'orders' folder
     }

     // Place an order from the cart
    public function placeOrder(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        // Calculate the total price
        $totalPrice = array_sum(array_map(function ($item) {
            return $item['price'] * $item['quantity'];
        }, $cart));

        // Create the order
        $order = Order::create([
            'user_id' => Auth::id(),
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);

        // Attach products to the order with quantities
        foreach ($cart as $productId => $item) {
            $order->products()->attach($productId, ['quantity' => $item['quantity']]);
        }

        // Clear the cart session
        session()->forget('cart');

        return redirect()->route('orders.index')->with('success', 'Order placed successfully!');
    }

}
