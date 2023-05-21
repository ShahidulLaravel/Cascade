<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Colors;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;


class SearchController extends Controller
{
     public function search(Request $request){
     $data = $request->all();

     $searched_products = Product::where(function($searched) use ($data){

          //for min
          $min = 0;
          if(!empty($data['min']) && ($data['min']) != '' && ($data['min']) != 'undefined'){
               $min = $data['min'];
          }else{
               $min = 1;
          }
          //for max
          $max = 0;
          if(!empty($data['max']) && ($data['max']) != '' && ($data['max']) != 'undefined'){
               $max = $data['max'];
          }else{
               $max = 10000000;
          }

          if(!empty($data['searched']) && ($data['searched']) != '' && ($data['searched']) != 'undefined'){
               $searched->where(function($searched) use ($data){
                    $searched->where('long_Desp', 'like', '%' .$data['searched'].'%');
                    $searched->orwhere('product_name', 'like', '%' .$data['searched'].'%');
               });
          }
          //for min and max
          if(!empty($data['min']) && ($data['min']) != '' && ($data['min']) != 'undefined' || !empty($data['max']) && ($data['max']) != '' && ($data['max']) != 'undefined'){
               $searched->whereBetween('after_discount', [$min, $max]);
          }
          //category
          if(!empty($data['category_id']) && $data['category_id'] != '' && $data['category_id'] != 'undefined'){
               $searched->where('category_id', $data['category_id']);
           }
          //brands
          if(!empty($data['brand_id']) && $data['brand_id'] != '' && $data['brand_id'] != 'undefined'){
               $searched->where('brand', $data['brand_id']);
           }
     })->get();

     //sending to search blade file
        $categories = Category::all();
        $brands = Brand::all();
        $sizes =Size::all();
        $colors = Colors::all();

        return view('frontend.customer.search',[
          'searched_products' => $searched_products,
          'categories' =>$categories,
          'brands'=>$brands,
          'sizes'=>$sizes,
          'colors'=>$colors,
        ]);
    }
}
