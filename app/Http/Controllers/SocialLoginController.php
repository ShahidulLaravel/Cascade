<?php

namespace App\Http\Controllers;

use App\Models\CustomerLogin;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
     //github login
    public function github_redirect(){
     return Socialite::driver('github')->redirect();
    }

    public function github_callback(){
          $user = Socialite::driver('github')->user();

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