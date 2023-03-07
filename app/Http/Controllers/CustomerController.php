<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Size;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use App\Models\CustomerLogin;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
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
        if($request->photo == ''){
            if($request->password == ''){
                CustomerLogin::find(Auth::guard('customerlogin')->id())->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'country' => $request->country,
                    'address' => $request->address,
                ]);
                return back()->with('success_one', 'Information Updated Successfully');
            }
            //password not blank 
            else{
                if(Hash::check($request->old_password, Auth::guard('customerlogin')->user()->password)){
                    CustomerLogin::find(Auth::guard('customerlogin')->id())->update([
                        'name' => $request->name,
                        'email' => $request->email,
                        'country' => $request->country,
                        'address' => $request->address,
                        'password' => Hash::make($request->password),
                    ]);
                    return back()->with('success_two', 'Information Updated Successfully');
                }else{
                    return back()->with('old', 'Your Old Password is Invalid'); 
                }
            }
        }

        // image not blank - else body 
        else{
            if ($request->password == '') {
                // image processing
                $photo = $request->photo;
                $extension = $photo->getClientOriginalExtension();
                $file_name = Auth::guard('customerlogin')->id(). '.'.$extension;
                Image::make($photo)->save(public_path('uploads/customer/'. $file_name)); 
                CustomerLogin::find(Auth::guard('customerlogin')->id())->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'country' => $request->country,
                    'address' => $request->address,
                    'photo' => $file_name,
                ]);
                return back()->with('success_one', 'Information Updated Successfully');
            }
            //password not blank 
            else {
                if (Hash::check($request->old_password, Auth::guard('customerlogin')->user()->password)) {
                    //image processing and update
                    $photo = $request->photo;
                    //$extension = $photo->getClientOriginalExtension();
                    $extension = $request->file('image')->getClientOriginalExtension();
                    $file_name = Auth::guard('customerlogin')->id() . '.' . $extension;
                    Image::make($photo)->save(public_path('uploads/customer/' . $file_name)); 
                    CustomerLogin::find(Auth::guard('customerlogin')->id())->update([
                        'name' => $request->name,
                        'email' => $request->email,
                        'country' => $request->country,
                        'address' => $request->address,
                        'password' => Hash::make($request->password),
                        'photo' => $file_name,
                    ]);
                    return back()->with('success_two', 'Information Updated Successfully');
                } 
                else {
                    return back()->with('old', 'Your Old Password is Invalid');
                }
            }
        }
    }

}
