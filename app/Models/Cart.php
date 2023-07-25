<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}

class Product extends Model
{
    public function inventory()
    {
        return $this->hasOne(Inventory::class);
    }

    public function carts()
    {
        return $this->belongsToMany(Cart::class);
    }
}
