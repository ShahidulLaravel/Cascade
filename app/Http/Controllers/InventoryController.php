<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Size;
use App\Models\Colors;
use App\Models\Product;
use App\Models\Category;
use App\Models\InventoryStore;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function add_inventory(){
        $all_colors = Colors::all();
        $sizes = Size::all();
        $categories = Category::all();
        return view('admin.product.add_inventory', [
            'all_colors' => $all_colors,
            'sizes' => $sizes,
            'categories' => $categories,
        ]);
    } 

    public function variation_store(Request $request){
        if($request->btn == 1){
            Colors::insert([
                'color_name' => $request->color_name,
                'color_code' => $request->color_code,
                'created_at' => Carbon::now(),
            ]);
        }else{
            Size::insert([
                'size_name' => $request->size_name,
                'category_id' => $request->category_id,
                'created_at' => Carbon::now(),
            ]);
        } 
         return back();
    }

    //add inventory

    public function add_invetory($inventory_add){
        $colors = Colors::all();
        $product_info = Product::find($inventory_add);
        $sizes = Size::where('category_id', $product_info->category_id)->get();
        $inventories = InventoryStore::all();
        return view('admin.product.inventory', [
            'sizes' => $sizes,
            'colors' => $colors,
            'product_info' => $product_info,
            'inventories' => $inventories,
        ]);
    }
    
    public function inventory_store(Request $request){
        if(InventoryStore::where('product_id', $request->product_id)->where('color_id', $request->color_id)->where('size_id', $request->size_id)->exists()){
            InventoryStore::where('product_id', $request->product_id)->where('color_id', $request->color_id)->where('size_id', $request->size_id)->increment('qtty', $request->qtty);
        }else{
          InventoryStore::insert([
                'product_id' => $request->product_id,
                'color_id' => $request->color_id,
                'size_id' => $request->size_id,
                'qtty' => $request->qtty,
                'created_at' => Carbon::now()
            ]);
        }
        return back();
    }
}

