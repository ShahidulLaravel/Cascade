<?php

namespace App\Http\Controllers;

use App\Models\CustomerLogin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Socialite;

class GoogleController extends Controller
{
    //google login
    public function google_redirect(){
     return Socialite::driver('google')->redirect();
    }

    public function google_callback(){
          $user = Socialite::driver('google')->user();

          if(CustomerLogin::where('email', $user->getEmail())->exists()){
               if(Auth::guard('customerlogin')->attempt(['email'=>$user->getEmail(), 'password'=>'@abc123'])){
                    return redirect('/');
               }
          }
          else
          {
               CustomerLogin::insert([
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                    'password' => bcrypt('@abc123'),
                    'created_at' => Carbon::now(),
                ]);
                if(Auth::guard('customerlogin')->attempt(['email'=>$user->getEmail(), 'password'=>'@abc123'])){
                    return redirect('/');
               }
          }
    }
}
