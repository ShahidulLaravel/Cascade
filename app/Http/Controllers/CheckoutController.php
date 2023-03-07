<?php

namespace App\Http\Controllers;

use App\Models\BillingDetails;
use Carbon\Carbon;
use App\Models\Cart;
use App\Models\City;
use App\Models\Order;
use App\Models\Country;
use App\Models\Checkout;
use App\Models\OrderProduct;
use App\Models\ShippingDetail;
use App\Models\ShippingDetails;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function view_chekout(Request $request){
        $carts = Cart::where('customer_id', Auth::guard('customerlogin')->id())->get();
        $countries = Country::all();
        $zips = City::all('state_code');
        return view('frontend.checkout.show',[
            'carts' => $carts,
            'countries' => $countries,
            'zips' => $zips,
        ]); 
    }

    public function get_city(Request $request)
    {
       $str = '<option value="">-- Select City --</option>';
       $cities = City::where('country_id', $request->country_id)->get();
       foreach($cities as $city){
            $str .= '<option value="'.$city->id.'">'.$city->name.'</option>';
       }
       echo $str;
    }

    public function order_store(Request $request){
       $city = City::find($request->city_id);
       $order_id = Str::upper(substr($city->name,'0','3')) . '-' . rand(10, 100000);

       Order::insert([
            'order_id' => $order_id,
            'customer_id' => Auth::guard('customerlogin')->id(),
            'sub_total' => $request->sub_total,
            'grand_total' => $request->grand_total,
            'discount' => $request->discount,
            'charge' => $request->charge,
            'payment_method' => $request->payment_method,
            'created_at' => Carbon::now(),
       ]);
       BillingDetails::insert([
            'order_id' => $order_id,
            'customer_id' => Auth::guard('customerlogin')->id(),
            'name' => Auth::guard('customerlogin')->user()->name,
            'email' => Auth::guard('customerlogin')->user()->email,
            'billing_mobile' => $request->billing_mobile,
            'company' => $request->company,
            'address' => Auth::guard('customerlogin')->user()->address,
            'created_at' => Carbon::now(),
       ]);
       ShippingDetail::insert([
            'order_id' => $order_id,
            'name' => $request->name,
            'email' => $request->email,
            'shipping_mobile' => $request->shipping_mobile,
            'address' => $request->address,
            'zip_code' => $request->zip_code,
            'notes' => $request->notes,
            'country_id' => $request->country_id,
            'city_id' => $request->city_id,
       ]);
     //   return back()->with('success','Congratulations ! Your Order Have been Placed'); 

     $carts = Cart::where('customer_id', Auth::guard('customerlogin')->id())->get();

          foreach($carts as $cart){
          OrderProduct::insert([
               'order_id' => $order_id,
               'customer_id' => Auth::guard('customerlogin')->id(),
               'product_id' => $cart->product_id,
               'color_id' => $cart->color_id,
               'size_id' => $cart->size_id,
               'quantity' => $cart->quantity,
               'price' => $cart->rel_with_product->after_discount,
               'created_at' => Carbon::now(),
               ]); 
          Cart::find($cart->id)->delete(); 
          }
          return redirect()->route('order.success', $order_id)->withSuccess('Your Order Is Placed !!');
    }

    public function order_success($order_id){
          if(session('success')){
               return view('frontend.order_success', compact('order_id'));
          }else{
               return view('frontend.error');
          }   
    }
}
