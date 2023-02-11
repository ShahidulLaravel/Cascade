<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\InventoryStore;
use App\Models\ProductGallery;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    function frontEnd(){
        $categories = Category::all();
        $products = Product::all();
        $brands = Brand::all();
        return view('Frontend.index',[
            'categories' => $categories,
            'products' => $products,
            'brands' => $brands,
        ]);
    }

    public function details($product_id){
        $product_info = Product::find($product_id);
        $product_gallery = ProductGallery::where('product_id',$product_id)->get();
        $related_product = Product::where('category_id', $product_info->category_id)->where('id', '!=', $product_id)->get();

        $colors = InventoryStore::where('product_id', $product_info->id)->groupBy('color_id')
        ->selectRaw('count(*) as total, color_id')
        ->get();

        $sizes = InventoryStore::where('product_id', $product_info->id)
        ->groupBy('size_id')
        ->selectRaw('count(*) as total, size_id')
        ->get();
        return view('frontend.details',[
            'product_info' => $product_info,
            'product_gallery' => $product_gallery,
            'related_product' => $related_product,
            'colors' => $colors,
            'sizes' => $sizes,
        ]);
    }
}
