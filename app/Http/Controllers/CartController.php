<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function add_cart(Request $request)
    {
        if($request->one == 1){
            if (Auth::guard('customerlogin')->id() != '') {
                Cart::insert([
                    'customer_id' => Auth::guard('customerlogin')->id(),
                    'product_id' => $request->product_id,
                    'color_id' => $request->color_id,
                    'size_id' => $request->size_id,
                    'quantity' => $request->quantity,
                ]);
                return back()->with('success', 'Product Added to Cart Successfully');
            } else {
                return redirect('/customer/Authentication')->with('warn', 'You Need To Login First');
            } 
        }
        else{
            if (Auth::guard('customerlogin')->id() != '') {
                Wishlist::insert([
                    'customer_id' => Auth::guard('customerlogin')->id(),
                    'product_id' => $request->product_id,
                    'color_id' => $request->color_id,
                    'size_id' => $request->size_id,
                    'quantity' => $request->quantity,
                ]);
                return back()->with('wish_success', 'Product Added into Wishlist');
            } else {
                return redirect('/customer/Authentication')->with('warn', 'You Need To Login First');
            }
        }
            
    }

    public function remove_cart($cart_id){
        Cart::find($cart_id)->delete();
        return back()->with('delete', 'Your Product is Removed from Cart');
    }
}
