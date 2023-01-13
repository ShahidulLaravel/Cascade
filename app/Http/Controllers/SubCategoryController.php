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

    // soft delete and restore
    public function subcategory_trash()
    {
        $trash = SubCategory::onlyTrashed()->get();
        return view('admin.category.sub_trash', [
            'trash' => $trash,
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

    public function subcategory_edit($edit_id){
        return view('admin.category.subcategory_edit');
    }

    public function subcategory_delete($delete_id)
    {
        SubCategory::find($delete_id)->delete();
        return back();
    }

    //subcategory restore
    public function subcategory_restore($restore_id){
        SubCategory::onlyTrashed()->find($restore_id)->restore();
        return redirect('/add/sub_category')->with('sub_restore', 'Restore Successfully');
    }
    //subcategory delete permanetly
    public function subcategory_delete_single($delete_id)
    {
        SubCategory::onlyTrashed()->find($delete_id)->forceDelete();
        return redirect('/subcategory/trash')->with('sub_del', 'Subcategory Permanently Deleted');
    }
    //dubcategory restore all
    public function subcategory_restore_all(Request $request){
        foreach($request->trash as $singel){
            SubCategory::onlyTrashed()->find($singel)->restore();
        }
        return redirect('/add/sub_category')->with('sub_restore', 'Restore Successfully');
    }

}
