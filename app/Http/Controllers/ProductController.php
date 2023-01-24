<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function add_product(){
        $categories = Category::all();
        $subcategories = SubCategory::all();
        return view('admin.product.add_product', [
            'categories' => $categories,
            'subcategories' => $subcategories,
        ]);
    }

    public function getSubcategory(Request $request){
       $subcategories = SubCategory::where('category_id', $request->category_id)->get();
       $str = '<option value="">-- Select subcategory --</option>';
       foreach($subcategories as $subcategory){
        $str .= '<option value="'.$subcategory->id.'">'.$subcategory->subcategory_name.'</option>';
       } 
       echo $str;
    }

    public function insert_product(Request $request){
        $after_discount =  $request->price - ( $request->price * $request->discount ) / 100 ;

        $sku = Str::upper(str_replace(' ', '-', substr($request->product_name,'0','1'))) . '-' . rand(10, 100000);
        $slug = Str::lower(str_replace(' ', '-', $request->product_name)) . '-' . rand(10, 100000);


        Product::insert([
            'product_name' => $request->product_name,
            'price' => $request->price,
            'discount' => $request->discount,
            'after_discount' => $after_discount,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'brand' => $request->brand,
            'short_desp' => $request->short_desp,
            'long_desp' => $request->long_desp,
            'additional_info' => $request->additional_info,
            'sku' => $sku,
            'slug' => $slug,
        ]);
        return back();
    }
}
