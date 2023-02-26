<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    function rel_with_product(){
        return $this->belongsTo(Product::class, 'product_id'); 
    }

    function rel_with_colors()
    {
        return $this->belongsTo(Colors::class, 'color_id');
    }

    function rel_with_sizes()
    {
        return $this->belongsTo(Size::class, 'size_id');
    }
}
