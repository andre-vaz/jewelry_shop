<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Notifications\OrderStatusUpdated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Show all orders for the authenticated user
    public function index()
    {
        $orders = Auth::user()->orders()->with('products')->get();
        return view('orders.index', compact('orders'));
    }

    // Show a specific order for the authenticated user
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

        $order = Order::create([
            'user_id' => Auth::id(),
            'total_price' => $this->calculateTotalPrice($validated['product_ids'], $validated['quantities']),
            'status' => 'pending',
        ]);

        $productData = [];
        foreach ($validated['product_ids'] as $index => $productId) {
            $productData[$productId] = ['quantity' => $validated['quantities'][$index]];
        }

        $order->products()->attach($productData);
        session()->forget('cart');

        return redirect()->route('orders.show', $order->id)
            ->with('success', 'Order placed successfully!');
    }

    // User-specific order update
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        if ($order->user_id != Auth::id() && !Auth::user()->is_admin) {
            return redirect()->route('orders.index')->with('error', 'Unauthorized action');
        }

        $order->update([
            'status' => $request->status,
        ]);

        return redirect()->route('orders.index')->with('success', 'Order status updated successfully!');
    }

    // User-specific order deletion
    public function destroy($id)
    {
        $order = Order::findOrFail($id);

        if ($order->user_id != Auth::id() && !Auth::user()->is_admin) {
            return redirect()->route('orders.index')->with('error', 'Unauthorized action');
        }

        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order deleted successfully!');
    }

    // Admin: Show all orders
    public function adminIndex()
    {
        $orders = Order::with('products', 'user')->get();
        return view('admin.orders.index', compact('orders'));
    }

    // Admin: Show a specific order
    public function adminShow($id)
    {
        $order = Order::with('products', 'user')->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    // Admin: Update order status and send notifications
    public function adminUpdate(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,completed,cancelled',
        ]);

        $order = Order::findOrFail($id);

        // Store the old status before updating
        $oldStatus = $order->status;
        $newStatus = $validated['status'];

        // Update the order status
        $order->update(['status' => $newStatus]);

        // Send a notification to the user about the status update
        // Only notify if the status actually changed
        if ($oldStatus !== $newStatus) {
            $order->user->notify(new OrderStatusUpdated($order, $newStatus));
        }

        return redirect()->route('admin.orders.index')->with('success', 'Order status updated successfully!');
    }

    // Admin: Delete an order
    public function adminDestroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('admin.orders.index')->with('success', 'Order deleted successfully!');
    }

    // Checkout method
    public function checkout()
    {
        $cartItems = session()->get('cart', []);
        $totalPrice = array_sum(array_map(function ($item) {
            return $item['price'] * $item['quantity'];
        }, $cartItems));

        return view('orders.checkout', compact('cartItems', 'totalPrice'));
    }

    // Place an order from the cart
    public function placeOrder(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        $totalPrice = array_sum(array_map(function ($item) {
            return $item['price'] * $item['quantity'];
        }, $cart));

        $order = Order::create([
            'user_id' => Auth::id(),
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);

        foreach ($cart as $productId => $item) {
            $order->products()->attach($productId, ['quantity' => $item['quantity']]);
        }

        session()->forget('cart');

        return redirect()->route('orders.index')->with('success', 'Order placed successfully!');
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
}
