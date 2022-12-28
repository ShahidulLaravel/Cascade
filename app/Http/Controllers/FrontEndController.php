<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    function frontEnd(){
        return view('FrontEnd.welcome');
    }
}
