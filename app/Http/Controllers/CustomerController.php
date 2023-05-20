<?php

namespace App\Http\Controllers;

use App\Models\CustomerEmailVerification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification as FacadesNotification;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use App\Models\CustomerLogin;
use App\Models\Order;
use App\Notifications\CustomerEmailNoti;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Auth\Notifications\VerifyEmail;

class CustomerController extends Controller
{
    public function customer_reg_log(){
        return view('frontend.customer.login_reg');
    }

    //store registerd user in DB
    public function customer_registration(Request $request){
        $request->validate([
            'email'=> 'required|unique:customer_logins',
        ]);
        $customer_id = CustomerLogin::insertGetId([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => Carbon::now(),
        ]);
        $customer = CustomerLogin::find($customer_id);

        CustomerEmailVerification::where('customer_id', $customer->id)->delete();

        $info = CustomerEmailVerification::create([
            'customer_id' => $customer->id,
            'token_no' => uniqid(),
            'created_at' => Carbon::now(),
        ]);
        
        FacadesNotification::send($customer, new CustomerEmailNoti($info));
        return back()->with('success_one', 'Please Verify Your Email First !!');
        
        return back()->with('success', 'Your Account has been Created Successfully !!');
    }

    public function customer_login(Request $request){
        if(Auth::guard('customerlogin')->attempt(['email' => $request->email, 'password' => $request->password])){
            if(Auth::guard('customerlogin')->user()->email_verified_at == null){
                return back()->with('not_verified', 'Your Email is not verified. please verify the email first');
            }else{
                return redirect('/');
            }    
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

    //my order
    public function myorder()
    {
        $myorders = Order::where('customer_id', Auth::guard('customerlogin')->id())->orderBy('created_at', 'DESC')->get();

        return view('frontend.customer.myorder', [
            'myorders' => $myorders,
        ]);
    }
    
    public function clear_myorder(){
        
    }

    public function detail_tracking(){
        return view('frontend.customer.track');
    }

    public function store_rating(Request $request){
        OrderProduct::where('customer_id', Auth::guard('customerlogin')->id())->where('product_id', $request->product_id)->update([
            'review' => $request->review,
            'star' => $request->rating,
        ]);
        return back();
    }

    //Email Verify
    public function email_verify($token_no){
        $customer = CustomerEmailVerification::where('token_no', $token_no)->firstorFail();
        CustomerLogin::find($customer->customer_id)->update([
            'email_verified_at' => Carbon::now(),
        ]);

        return redirect()->route('customer.register.login')->with('success_two','Email Verified Successfully');
    }

    public function email_verify_again(){
        return view('frontend.customer.email_resend');
    }

    public function resend_email_verify_again(Request $request){
        if(CustomerLogin::where('email', $request->email)->exists()){
            $customer = CustomerLogin::where('email', $request->email)->firstorFail();
            CustomerEmailVerification::where('customer_id', $customer->id)->delete();
            $info = CustomerEmailVerification::create([
                'customer_id' => $customer->id,
                'token_no' => uniqid(),
                'created_at' => Carbon::now(),
            ]);
            FacadesNotification::send($customer, new CustomerEmailNoti($info));
            return back()->with('success_three', 'We send a Verification mail in your email address');
        }else{

            return back()->with('warn', 'You didnot Registered Yet !!');
        }
    }


}