<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryStore extends Model
{
    use HasFactory;

    function product_rel(){
       return $this->belongsTo(Product::class, 'product_id'); 
    }

    function color_rel()
    {
        return $this->belongsTo(Colors::class, 'color_id');
    }

    function size_rel()
    {
        return $this->belongsTo(Size::class, 'size_id');
    }
}
