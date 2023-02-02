<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class UpdateProdcutController extends Controller
{
    public function update_product(Request $request){
        // if($request->preview == null){
        //     $preview = $request->preview;
        //     $extension = $preview->getClientOriginalExtension();
        //     $file_name = Str::lower(str_replace(' ', '-', $request->product_name)) . '-' . rand(100, 100000) . '.' . $extension;

        //     Image::make($preview)->save(public_path('uploads/products/preview' . $file_name));
        // }

        Product::find($request->product_update_id)->update([
            'product_name' => $request->product_name,
            //'preview' => $file_name,
            'price' => $request->price,
            'discount' => $request->discount,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'brand' => $request->brand,
            'short_desp' => $request->short_desp,
            'long_desp' => $request->long_desp,
            'addtional_info' => $request->addtional_info,
                    
        ]);
        return back()->with('success', 'Product Updated Successfully'); 
    }
}
