<?php

namespace App\Http\Controllers;

use App\Models\Size;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\InventoryStore;
use App\Models\ProductGallery;

class FrontEndController extends Controller
{
    function frontEnd(){
        $categories = Category::all();
        $products = Product::take(8)->latest()->get();
        $brands = Brand::all();
        $sizes = Size::all();
        return view('Frontend.index',[
            'categories' => $categories,
            'products' => $products,
            'brands' => $brands,
            'sizes' => $sizes,
        ]);
    }

    public function show_all(){
        $categories = Category::all();
        $products = Product::all();
        $brands = Brand::all();
        $sizes = Size::all();
        return view('frontend.all_products', [
            'categories' => $categories,
            'products' => $products,
            'brands' => $brands,
            'sizes' => $sizes,
        ]);
    }

    public function details($product_id){
        $product_info = Product::find($product_id);
        $product_gallery = ProductGallery::where('product_id',$product_id)->get();
        $related_product = Product::where('category_id', $product_info->category_id)->where('id', '!=', $product_id)->get();

        $colors = Product::where('id', $product_info->id)->groupBy('color_id')
        ->selectRaw('count(*) as total, color_id')
        ->get();

        $sizes = Product::where('id', $product_info->id)
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

    public function getSize(Request $request){
        $sizes = Product::where('id', $request->product_id)->where('color_id', $request->color_id)->get();
        $str = '';

       
        foreach($sizes as $size){
            if($size->id == 1){
                $str .= '<div class="form-check size-option form-option form-check-inline mb-2"><input checked class="form-check-input" type="radio" name="size_id" value="' . $size->size_id . '" id="size' . $size->size_id . '"/>
                <label class="form-option-label"for="size' . $size->size_id . '">' . $size->size_rel->size_name . '</label>
                </div>';
            }else{
                $str .= '<div class="form-check size-option form-option form-check-inline mb-2"><input class="form-check-input" type="radio" name="size_id" value="' . $size->size_id . '" id="size' . $size->size_id . '"/>
                <label class="form-option-label"for="size' . $size->size_id . '">' . $size->size_rel->size_name . '</label>
                </div>';
            }
           
        }
        echo $str;
    }
}
