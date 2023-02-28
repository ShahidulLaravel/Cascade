<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Checkout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function view_chekout(Request $request){
        $carts = Cart::where('customer_id', Auth::guard('customerlogin')->id())->get();
        return view('frontend.checkout.show',[
            'carts' => $carts,
        ]);
    }

    public function chekout_store(Request $request){
        Checkout::insert([
            'name' => $request->name,
            'ship_name' => $request->ship_name,
            'email' => $request->email,
            'ship_email' => $request->ship_email,
            'company' => $request->company,
            'bill_phone' => $request->bill_phone,
            'ship_phone' => $request->ship_phone,
            'additional_phone' => $request->additional_phone,
            'address' => $request->address,
            'country' => $request->country,
            'city' => $request->city,
            'zip_code' => $request->zip_code,
            'additional' => $request->additional,
        ]);
        return back();
    }
}
