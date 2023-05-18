<?php

namespace App\Http\Controllers;

use App\Models\CustomerLogin;
use App\Models\CustomerPasswordReset;
use App\Notifications\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification as FacadesNotification;


class PasswordResetController extends Controller
{
    public function forgot_password(){
        return view('frontend.customer.password_reset');
    }

    public function send_request(Request $request){
      $request->validate([
        'email' => 'required',
      ]);
      if(CustomerLogin::where('email', $request->email)->exists()){
        $customer = CustomerLogin::where('email', $request->email)->firstorFail();
        CustomerPasswordReset::where('customer_id', $customer->id)->delete();
        $info = CustomerPasswordReset::create([
          'customer_id' => $customer->id,
          'token' => uniqid(),
        ]);
        FacadesNotification::send($customer, new PasswordReset($info, $customer));
        return back()->with('success', 'A Reset Request Has been sent in Your Email');

      }else{
        return back()->with('error', 'Email Not Matched !! Try again with Regesterd Email');
      }
    }

    public function password_reset_form($token){
      return view('frontend.customer.password_set',[
        'token' => $token,
      ]);
    }
    public function password_set(Request $request){
      $reset_info = CustomerPasswordReset::where('token', $request->token)->firstorFail();
      CustomerLogin::find($reset_info->customer_id)->update([
        'password'=> bcrypt($request->password),
      ]);
    CustomerPasswordReset::where('customer_id', $reset_info->customer_id)->delete();
      return back()->with('success', 'Your Password was Change Successfully');
    }
}
