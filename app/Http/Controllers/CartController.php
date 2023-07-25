<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;

class CartController extends Controller
{
    /**
     * Display the user's cart.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user(); // get the logged in user
        $cart = Cart::where('user_id', $user->id)->with('product')->get();

        return response()->json($cart);
    }

    /**
     * Add a product to the user's cart.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = $request->user(); // get the logged in user
        $product_id = $request->input('product_id'); // get the product id from request
        $quantity = $request->input('quantity'); // get the quantity from request

        $cart = new Cart;
        $cart->user_id = $user->id;
        $cart->product_id = $product_id;
        $cart->quantity = $quantity;
        $cart->save();

        return response()->json(['message' => 'Product added to cart successfully.']);
    }

    /**
     * Update the specified resource in the user's cart.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = $request->user(); // get the logged in user
        $product_id = $request->input('product_id'); // get the product id from request
        $quantity = $request->input('quantity'); // get the quantity from request

        $cart = Cart::where('user_id', $user->id)->where('product_id', $product_id)->first();
        if($cart){
            $cart->quantity = $quantity;
            $cart->save();

            return response()->json(['message' => 'Product quantity updated successfully.']);
        } else {
            return response()->json(['message' => 'Product not found in cart.'], 404);
        }
    }

    /**
     * Remove the specified product from the user's cart.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $user = $request->user(); // get the logged in user
        $product_id = $request->input('product_id'); // get the product id from request

        $cart = Cart::where('user_id', $user->id)->where('product_id', $product_id)->first();
        if($cart){
            $cart->delete();

            return response()->json(['message' => 'Product removed from cart successfully.']);
        } else {
            return response()->json(['message' => 'Product not found in cart.'], 404);
        }
    }
}



