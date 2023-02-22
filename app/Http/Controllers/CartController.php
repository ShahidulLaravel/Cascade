<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function add_cart(Request $request)
    {
        Cart::insert([
            'customer_id' => Auth::guard('customerlogin')->id(),
            'product_id' => $request->product_id,
            'color_id' => $request->color_id,
            'size_id' => $request->size_id,
            'quantity' => $request->quantity,
        ]);
        return back()->with('success', 'Product Added to Cart Successfully');
        
    }

    public function remove_cart($cart_id){
        Cart::find($cart_id)->delete();
        return back()->with('delete', 'Your Product is Removed from Cart');
    }
}
