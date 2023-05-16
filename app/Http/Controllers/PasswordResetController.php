<?php

namespace App\Http\Controllers;

use App\Models\CustomerLogin;
use Illuminate\Http\Request;

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
        

      }else{
        return back()->with('error', 'Email Not Matched !! Try again with Regesterd Email');
      }
    }
}
