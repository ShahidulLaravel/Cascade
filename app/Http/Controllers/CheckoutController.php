<?php

namespace App\Http\Controllers;

use App\Mail\CustomerInvoiceMail;
use Carbon\Carbon;
use App\Models\Cart;
use App\Models\City;
use App\Models\Order;
use App\Models\Country;
use App\Models\Product;
use App\Models\Checkout;
use Illuminate\Support\Str;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use App\Models\BillingDetails;
use App\Models\Logo;
use App\Models\ShippingDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
       $logo = Logo::all();

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

          Product::where('color_id', $cart->color_id)->where('size_id', $cart->size_id)->where('id', $cart->product_id)->decrement('quantity', $cart->quantity);

          Cart::find($cart->id)->delete(); 
          }

          //sendinng customer invoice email here
          $mail = Auth::guard('customerlogin')->user()->email;
          Mail::to($mail)->send(new CustomerInvoiceMail($order_id, $logo));

          //sending sms to our users
          $total = $request->sub_total + $request->charge - ($request->discount);
          $url = "http://bulksmsbd.net/api/smsapi";
          $api_key = "LKtAwgFOslq2CUFPVqTL";
          $senderid = "Shahidul_23";
          $number = $request->billing_mobile;
          $message = "Congratulations, Your order has been Placed.Thank you for shopping With us. Please ready Tk ".$total;

          $data = [
               "api_key" => $api_key,
               "senderid" => $senderid,
               "number" => $number,
               "message" => $message
          ];
          $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL, $url);
          curl_setopt($ch, CURLOPT_POST, 1);
          curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
          $response = curl_exec($ch);
          curl_close($ch);

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
