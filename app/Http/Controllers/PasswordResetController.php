<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PasswordResetController extends Controller
{
    public function forgot_password(){
        return view('frontend.customer.password_reset');
    }
}
