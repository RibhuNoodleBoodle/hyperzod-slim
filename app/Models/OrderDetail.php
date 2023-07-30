<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Cart;
use App\Events\OrderStatusChangedEvent;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('quantity');
            $table->decimal('price', 8, 2);
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    public function show(Order $order) {
        if (auth()->id() !== $order->user_id) {
            return response()->json(['error' => 'This order does not belong to you.'], 403);
        }

        $order->load('orderDetails.product');

        return $order;
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'cart_id' => 'required|exists:carts,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = auth()->user();
        $cart = Cart::find($request->cart_id);

        if ($cart->products->isEmpty()) {
            return response()->json(['error' => 'No products in cart to order.'], 400);
        }

        $total = $cart->products->sum(function ($product) {
            return $product->price;
        });

        $order = $user->orders()->create(['total' => $total]);

        foreach ($cart->products as $product) {
            $order->orderDetails()->create([
                'product_id' => $product->id,
                'quantity' => 1,
                'price' => $product->price,
            ]);

            $product->inventory->quantity -= 1;
            $product->inventory->save();

            $cart->products()->detach($product->id);
        }

        event(new OrderStatusChangedEvent($order));

        return response()->json(['success' => 'Order placed successfully.', 'order' => $order], 201);
    }
}

