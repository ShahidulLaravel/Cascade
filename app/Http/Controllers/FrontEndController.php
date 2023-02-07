<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    function frontEnd(){
        $categories = Category::all();
        $products = Product::take(8)->latest()->get();
        $brands = Brand::all();
        return view('Frontend.index',[
            'categories' => $categories,
            'products' => $products,
            'brands' => $brands,
        ]);
    }
}
