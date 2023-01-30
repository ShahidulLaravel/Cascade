<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductGallery;
use Intervention\Image\Facades\Image;

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
            //identify the after discount, product code and slug 
            $after_discount =  $request->price - ($request->price * $request->discount) / 100;
            $sku = Str::upper(str_replace(' ', '-', substr($request->product_name, '0', '1'))) . '-' . rand(10, 100000);
            $slug = Str::lower(str_replace(' ', '-', $request->product_name)) . '-' . rand(10, 100000);

            //insert product without preview/thumb image
            $product_id = Product::insertGetId([
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
                'created_at' => Carbon::now(),
            ]);
            // update product image 
            $preview_image = $request->preview;
            if($preview_image != ''){
                $extension = $preview_image->getClientOriginalExtension();
                $file_name = Str::lower(str_replace(' ', '-', $request->product_name)) . '-' . rand(10, 100000) . '.' . $extension;
                Image::make($preview_image)->save(public_path('uploads/Products/preview/' . $file_name));

                Product::find($product_id)->update([
                    'preview' => $file_name
                ]);
            }
        // insert product gallery
        $product_gel = $request->product_gallery;

        foreach ($product_gel as $product) {
            
            $extension_two = $product->getClientOriginalExtension();
            $file_name_two = Str::lower(str_replace(' ', '-', $request->product_name)) . '-' . rand(10, 100000) . '.' . $extension_two;

            Image::make($product)->save(public_path('uploads/Products/gallery/' . $file_name_two));

            ProductGallery::insert([
                'product_id' => $product_id,
                'product_gallery' => $file_name_two,
                'created_at' => Carbon::now(),
            ]);         
        } 
        return back()->with('success', 'Product Addedd Successfully');
    }     

}
