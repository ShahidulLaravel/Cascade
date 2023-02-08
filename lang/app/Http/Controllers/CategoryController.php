<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    public function category(){
        $show_category = Category::all();
        $trash_category = Category::onlyTrashed()->get();
        return view('admin.category.category', [
            'show_category' => $show_category,
            'trash_category' => $trash_category
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

    public function edit_category($category_edit_id){
        $category_info = Category::find($category_edit_id);
        return view('admin.category.edit_category',[
            'category_info' => $category_info,
        ]);
    }

    public function update_category(Request $request){
        if($request->category_image == null){
            Category::find($request->update_id)->update([
                'category_name' => $request->category_name
            ]);
        }
        else{
            $category_image = $request->category_image;
            $extension = $category_image->getClientOriginalExtension();
            $file_name = Str::lower(str_replace(' ', '-', $request->category_name)) . '-' . rand(10, 100000) . '.' . $extension;

            Image::make($category_image)->save(public_path('uploads/categories/' . $file_name));

            Category::find($request->update_id)->update([
                'category_name' => $request->category_name,
                'category_image' => $file_name
            ]);
        }
        return back();
    }

    // soft delete and restore
    public function category_trash(){
        $trash_category = Category::onlyTrashed()->get();
        return view('admin.category.trash',[
            'trash_category' => $trash_category,
        ]);
    }
    //single restore
    public function category_restore_single($user_id){
        Category::onlyTrashed()->find($user_id)->restore();
        return back();
    }
    //single delete permanently
    public function category_perDelete_single($user_id){
        //delete previous
        $present_img = Category::onlyTrashed()->find($user_id);
        $delete_from = public_path('uploads/categories/' . $present_img->category_image);
        unlink($delete_from);

        $subcategories = SubCategory::where('category_id', $user_id)->get();
        foreach ($subcategories as $sub) {
            $present_img = SubCategory::find($sub->id);
            $delete_from = public_path('uploads/subcategories/' . $present_img->subcategory_image);
            unlink($delete_from);

            SubCategory::find($sub->id)->delete();
        }

        Category::onlyTrashed()->find($user_id)->forceDelete();
        return back();
    }
    //restore all 
    public function category_restoreAll(Request $request){
        
        foreach($request->trash as $category){
            Category::onlyTrashed()->find($category)->restore();
        }
        return back();
    }

}

