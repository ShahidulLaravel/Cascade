<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Size;
use App\Models\Brand;
use App\Models\Colors;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\InventoryStore;

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

    public function inventory_delete($delete_id){
        InventoryStore::where('id', $delete_id)->delete();
        return back()->with('success', 'Inventory Deleted Successfully');
    }

    public function colors_delete($delete_id_colors){
        Colors::where('id', $delete_id_colors)->delete();
        return back()->with('success', 'Colors Deleted Successfully');
    } 
    public function size_delete($delete_id_size){
        Size::where('id', $delete_id_size)->delete();
        return back()->with('success', 'Size Deleted Successfully');
    } 
    public function brand_delete($delete_id_brand){
        Brand::where('id', $delete_id_brand)->delete();
        return back()->with('success', 'Brand Deleted Successfully');
    }
    public function product_delete($delete_id_product){
        Product::where('id', $delete_id_product)->delete();
        return back()->with('success', 'Your Product is Deleted Successfully');
    }
}

