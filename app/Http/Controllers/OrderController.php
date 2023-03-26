<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Barryvdh\DomPDF\PDF;
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

    public function track_order(Request $request){
        Order::where('order_id', $request->order_id)->update([
            'status' => $request->status
        ]);
        return back();
    }

    public function dowonload_invoice($order_id){
        $info = Order::find($order_id);
        $order_id = $info->order_id;
        $pdf = PDF::loadView('frontend.customer.new_invoice',[
            'order_id' => $order_id,
        ]);
        return $pdf->download('invoice.pdf');
    }

}
