<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductGallery;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Intervention\Image\Facades\Image;

class UpdateProdcutController extends Controller
{
    public function update_product(Request $request){ 
        if($request-> preview == ''){
            if($request->product_gallery == ''){
                Product::find($request->product_update_id)->update([
                    'product_name' => $request->product_name,
                    'price' => $request->price,
                    'discount' => $request->discount,
                    'after_discount' => $request->price - ($request->price * $request->discount) / 100,
                    'category_id' => $request->category_id,
                    'subcategory_id' => $request->subcategory_id,
                    'brand' => $request->brand,
                    'short_desp' => $request->short_desp,
                    'long_desp' => $request->long_desp,
                    'additional_desp' => $request->additional_desp,
                    'created_at' => Carbon::now(),
                ]);
            }else{
                $preview_image = $request->preview;
                if ($preview_image != '') {
                    $extension = $preview_image->getClientOriginalExtension();
                    $file_name = Str::lower(str_replace(' ', '-', $request->product_name)) . '-' . rand(10, 100000) . '.' . $extension;
                    Image::make($preview_image)->save(public_path('uploads/Products/preview/' . $file_name));

                    Product::find($request->product_id)->update([
                        'preview' => $file_name
                    ]);
                }  
        }
        //preview have 
        }else{
            if($request->product_gallery == ''){
                $preview_image = $request->preview;
                $extension = $preview_image->getClientOriginalExtension();
                $file_name = Str::lower(str_replace(' ', '-', $request->product_name)) . '-' . rand(10, 100000) . '.' . $extension;
                Image::make($preview_image)->save(public_path('uploads/Products/preview/' . $file_name));

                Product::find($request->product_update_id)->update([
                    'product_name' => $request->product_name,
                    'price' => $request->price,
                    'discount' => $request->discount,
                    'after_discount' => $request->price - ($request->price * $request->discount) / 100,
                    'category_id' => $request->category_id,
                    'subcategory_id' => $request->subcategory_id,
                    'brand' => $request->brand,
                    'short_desp' => $request->short_desp,
                    'long_desp' => $request->long_desp,
                    'additional_desp' => $request->additional_desp,
                    'created_at' => Carbon::now(),
                    'preview' => $file_name,
                ]); 
            }else{
                //one
                
                //two
                $preview_image = $request->preview;
                $extension = $preview_image->getClientOriginalExtension();
                $file_name = Str::lower(str_replace(' ', '-',
                    $request->product_name
                )) . '-' . rand(10, 100000) . '.' . $extension;
                Image::make($preview_image)->save(public_path('uploads/Products/preview/' . $file_name));
                //three
                Product::find($request->product_update_id)->update([
                    'product_name' => $request->product_name,
                    'price' => $request->price,
                    'discount' => $request->discount,
                    'after_discount' => $request->price - ($request->price * $request->discount) / 100,
                    'category_id' => $request->category_id,
                    'subcategory_id' => $request->subcategory_id,
                    'brand' => $request->brand,
                    'short_desp' => $request->short_desp,
                    'long_desp' => $request->long_desp,
                    'additional_desp' => $request->additional_desp,
                    'created_at' => Carbon::now(),
                    'preview' => $file_name,
                ]);         
            }
        }
        return back();
    }
}
