<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SubCategoryController extends Controller
{
    public function subcategory(){
        $categories = Category::all();
        $subcategories = SubCategory::all();
        return view('admin.category.subcategory',[
            'categories' => $categories,
            'subcategories'=> $subcategories,
        ]);
    }

    public function subcategory_insert(Request $request){
        if($request->subcategory_image == null){
            SubCategory::insert([
                'subcategory_name' => $request->subcategory_name,
                'category_id' => $request->category_id,
            ]);
        }else{
            $subcategory_image = $request->subcategory_image;
            $extension = $subcategory_image->getClientOriginalExtension();
            $file_name = Str::lower(str_replace(' ', '-', $request->subcategory_name)) . '-' . rand(10, 100000) . '.' . $extension;

            Image::make($subcategory_image)->save(public_path('uploads/subcategories/' . $file_name));

            SubCategory::insert([
                'subcategory_name' => $request->subcategory_name,
                'subcategory_image' =>$file_name,
                'category_id' => $request->category_id,
            ]);
        }
        return back()->with('success', 'Subcategory Added Successfully');
    }
}
