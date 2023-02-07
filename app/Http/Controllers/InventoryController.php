<?php

namespace App\Http\Controllers;

use App\Models\Colors;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function add_inventory(){
        $all_colors = Colors::all();
        return view('admin.product.add_inventory', [
            'all_colors' => $all_colors,
        ]);
    } 

    public function variation_store(Request $request){
         Colors::insert([
            'color_name' => $request->color_name,
            'color_code' => $request->color_code,
            'created_at' => Carbon::now(),
         ]);
         return back();
    }
}
