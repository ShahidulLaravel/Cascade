<?php

namespace App\Http\Controllers;

use App\Models\Cupon;
use Illuminate\Http\Request;

class CuponController extends Controller
{
    public function add_cupon(){
        $cupons = Cupon::all();
        return view('admin.cupon.add', [
            'cupons' => $cupons,
        ]);
    }

    public function store_cupon(Request $request){
        Cupon::insert([
           'cupon_name' => $request->cupon_name, 
           'type' => $request->type, 
           'amount' => $request->amount, 
           'expiry_date' => $request->expiry_date, 
        ]);
        return back();
    }
}
