<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\CustomerLogin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;

class CustomerController extends Controller
{
    public function customer_reg_log(){
        return view('frontend.customer.login_reg');
    }

    public function customer_registration(Request $request){
        CustomerLogin::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => Carbon::now(),
        ]);
        return back()->with('success', 'Your Account has been Created Successfully !!');
    }

    public function customer_login(Request $request){
        if(Auth::guard('customerlogin')->attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect('/');
        }else{
            return back()->with('warning', 'Invalid Login Credintials ! Try Again');
        }
    }

    public function customer_logout(){
        Auth::guard('customerlogin')->logout();

        return back();
    }

    public function customer_profile(){
        return view('frontend.customer.profile');
    }

    public function customer_profile_update(Request $request){
        
    }
}
