<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Cart;
use App\Events\OrderStatusChangedEvent;

class OrderController extends Controller
{
    public function show(Order $order) {
        // Ensuring only the user who owns the order can see it
        if (auth()->id() !== $order->user_id) {
            return response()->json(['error' => 'This order does not belong to you.'], 403);
        }

        // Eager load the order details to minimize SQL queries
        $order->load('orderDetails.product');

        return $order;
    }

    public function store(Request $request) {
        $user = auth()->user();
        $cart = $user->cart;
        
        // Ensuring there are products in the cart before placing an order
        if ($cart->products->isEmpty()) {
            return response()->json(['error' => 'No products in cart to order.'], 400);
        }

        // Calculate total order cost
        $total = $cart->products->sum(function ($product) {
            return $product->price; // Replace with your logic
        });

        // Create a new order
        $order = $user->orders()->create(['total' => $total]);

        // Create order details
        foreach ($cart->products as $product) {
            $order->orderDetails()->create([
                'product_id' => $product->id,
                'quantity' => 1, // Replace with your logic
                'price' => $product->price, // Replace with your logic
            ]);

            // Subtract from product inventory
            $product->inventory->quantity -= 1; // Replace with your logic
            $product->inventory->save();

            // Remove product from cart
            $cart->products()->detach($product->id);
        }

        // Broadcast order status changed event
        event(new OrderStatusChangedEvent($order));

        return response()->json(['success' => 'Order placed successfully.', 'order' => $order], 201);
    }
}

