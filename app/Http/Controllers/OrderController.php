<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function orders(){
        $myorder = Order::all();
       return view('admin.orders.orders',[
        'myorder' => $myorder,
       ]); 
    }

    public function order_status(Request $request){
       
    }
}
