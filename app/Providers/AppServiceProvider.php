<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Inventory;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        OrderDetail::created(function ($orderDetail) {
            // Fetch the inventory for the product
        $inventory = Inventory::where('product_id', $orderDetail->product_id)->first();

            // Deduct the ordered quantity from the inventory
        $inventory->quantity -= $orderDetail->quantity;
            
            // Check if the product is now out of stock
        if($inventory->quantity <= 0){
            $product = Product::find($orderDetail->product_id);
            $product->out_of_stock = true; // assuming you have a boolean field in product table to mark a product out of stock.
            $product->save();
        }
        $inventory->save();
    });
}
}