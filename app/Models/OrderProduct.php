<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;

    protected $guraded = ['id'];

    function rel_with_product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    function rel_with_colors()
    {
        return $this->belongsTo(Colors::class, 'color_id');
    }

    function rel_with_sizes()
    {
        return $this->belongsTo(Cart::class, 'size_id');
    }
    function rel_with_wishlist()
    {
        return $this->belongsTo(Wishlist::class, 'size_id');
    }
    function rel_with_order()
    {
        return $this->belongsTo(OrderProduct::class, 'order_id');
    }

    function rel_with_grand()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

}
