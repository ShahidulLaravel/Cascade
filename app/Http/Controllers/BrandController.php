<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    public function brand()
    {
        $brands = Brand::Paginate(5);
        return view('admin.Brand.add_brand',[
            'brands' => $brands
        ]);
    }

    public function brand_insert(Request $request){
        $product_brand = $request->brand_logo;
        $extension_two = $product_brand->getClientOriginalExtension();
        $file_name_two = Str::lower(str_replace(' ', '-', $request->brand_name)) . '-' . rand(10, 100000) . '.' . $extension_two;

        Image::make($product_brand)->save(public_path('uploads/Products/brand/' . $file_name_two));
        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_logo' => $file_name_two,
        ]);
        return back();
    }


}
