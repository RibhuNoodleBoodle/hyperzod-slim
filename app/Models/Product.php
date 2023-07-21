<?php

// app/Models/Product.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'inventory',
    ];

    public function getInventoryStatusAttribute()
    {
        return $this->inventory > 0 ? 'Available' : 'Out of Stock';
    }
}
