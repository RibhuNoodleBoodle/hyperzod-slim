<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use DB;

class OrderController extends Controller
{
    /**
     * Place an order.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = $request->user(); // get the logged in user

        // Get user's cart
        $cartItems = Cart::where('user_id', $user->id)->with('product')->get();

        if($cartItems->isEmpty()){
            return response()->json(['message' => 'Cart is empty.']);
        }

        // Create a new order
        $order = new Order;
        $order->user_id = $user->id;
        $order->status = 'pending';
        $order->save();

        // Calculate total amount
        $totalAmount = 0;
        foreach($cartItems as $item){
            $totalAmount += $item->product->price * $item->quantity;

            // Create order details
            $orderDetail = new OrderDetail;
            $orderDetail->order_id = $order->id;
            $orderDetail->product_id = $item->product_id;
            $orderDetail->quantity = $item->quantity;
            $orderDetail->price = $item->product->price;
            $orderDetail->save();

            // Remove item from cart
            $item->delete();
        }

        // Update total amount in order
        $order->total_amount = $totalAmount;
        $order->save();

        return response()->json(['message' => 'Order placed successfully.', 'order_id' => $order->id]);
    }

    /**
     * Display the user's order history.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user(); // get the logged in user

        $orders = Order::where('user_id', $user->id)->with('orderDetails.product')->get();

        return response()->json($orders);
    }

    /**
     * Display the specified order detail.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $user = $request->user(); // get the logged in user

        $order = Order::where('user_id', $user->id)->where('id', $id)->with('orderDetails.product')->first();

        if(!$order){
            return response()->json(['message' => 'Order not found.'], 404);
        }

        return response()->json($order);
    }
}


