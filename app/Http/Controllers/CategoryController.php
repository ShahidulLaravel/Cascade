<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    public function category(Request $request){
        $show_category = Category::all();
        return view('admin.category.category', [
            'show_category' => $show_category
        ]);
    }

    public function add_category(Request $request){
        $request->validate([
            'category_name' => ['required', 'unique:categories'],
            'category_image' => ['required', 'image']
        ]);

        if($request->category_image == null){
            Category::insert([
                'category_name' => $request->category_name
            ]);
        }else{
            $category_image = $request->category_image;
            $extension = $category_image->getClientOriginalExtension();
            $file_name = Str::lower(str_replace(' ', '-', $request->category_name)).'-'.rand(10,100000).'.'.$extension;

            Image::make($category_image)->save(public_path('uploads/categories/' . $file_name));

            Category::insert([
                'category_name' => $request->category_name,
                'category_image' => $file_name
            ]);
            return back()->with('success', 'Category Addedd Successfully');
        }
        return back()->with('error', 'Add a Category First');
    }

    public function delete_category($category_id){
        Category::find($category_id)->delete();
        return back()->with('cat_success', 'Category Deleted Successfully');
    }
}
