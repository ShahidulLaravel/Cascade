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
    public function show_searchPage(){
        $searched_products = Product::all();
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
