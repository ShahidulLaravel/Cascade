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
     //sorting
     $sorting = 'created_at';
     $type = 'DESC';

        if (!empty($data['sort']) && $data['sort'] != '' && $data['sort'] != 'undefined') {
            if ($data['sort'] == 1) {
                $sorting = 'product_name';
                $type = 'ASC';
            } else if ($data['sort'] == 2) {
                $sorting = 'product_name';
                $type = 'DESC';
            } else if ($data['sort'] == 3) {
                $sorting = 'after_discount';
                $type = 'ASC';
            } else if ($data['sort'] == 4) {
                $sorting = 'after_discount';
                $type = 'DESC';
            }
        }

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

           //color and size
           if(!empty($data['color_id']) && $data['color_id'] != '' && $data['color_id'] != 'undefined' || !empty($data['size_id']) && $data['size_id'] != '' && $data['size_id']){

               $searched->whereHas('rel_product', function($searched) use ($data){
                    if(!empty($data['color_id']) && $data['color_id'] != '' && $data['color_id'] != 'undefined')
                    {
                         $searched->whereHas('color_rel', function($searched) use ($data){
                              $searched->where('colors.id', $data['color_id']);
                         });
                    }
                    //size
                    if(!empty($data['size_id']) && $data['size_id'] != '' && $data['size_id'] != 'undefined'){
                         $searched->whereHas('size_rel', function ($searched) use ($data){
                             $searched->where('sizes.id', $data['size_id']);
                         });
                     }
               });
           }

     })->orderBy($sorting,$type)->get();

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
