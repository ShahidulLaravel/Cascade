<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Size;
use App\Models\Cupon;
use App\Models\Colors;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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

    public function remove_wishlist($wish_id){
        Wishlist::find($wish_id)->delete();
        return back()->with('wish_delete', 'Your Product is Removed from Wishlist');
    }

    public function view_cart(Request $request){
        $discount = 0;
        $type = '';
        $mesg = '';    

        if(Cupon::where('cupon_name', $request->cupon_name)->exists()){
            if(Carbon::now()->format('Y-m-d') <= Cupon::where('cupon_name', $request->cupon_name)->first()->expiry_date){
                if(Cupon::where('cupon_name', $request->cupon_name)->first()->type == 1){
 
                    $discount = Cupon::where('cupon_name', $request->cupon_name)->first()->amount;
                    $type = 1;
                
                }else{              
                    $discount = Cupon::where('cupon_name', $request->cupon_name)->first()->amount;
                    $type = 2;
                }

            }else{
                
               // return back()->with('warn_one', 'Cupon Expired');
            }

        }else{
            
            //return back()->with('warn_two', 'Cupon Doesnot Exist');
        }

        $carts = Cart::where('customer_id', Auth::guard('customerlogin')->id());
        return view('frontend.view_cart',[
            'carts' => $carts,
            'discount' => $discount,
            'type' => $type,
            'mesg' => $mesg,
        ]);
    }

    public function update_cart(Request $request){
             
        foreach($request->quantity as $cart_id=>$qtty){
        
            Cart::find($cart_id)->update([
                'quantity' => $qtty,
            ]);
        }
        return back()->with('success_update','Cart Updated Successfully');
    }

    public function cart_remove(Request $request){
        Cart::where('id', $request->id)->delete();
        return back();
    }
}
