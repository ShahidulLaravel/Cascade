<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function category(Request $request){
        return view('admin.category.category');
    }

    public function add_category(Request $request){
        $request->validate([
            'category_name' => ['required'],
            'category_image' => ['required', 'image']
        ]);
        return back()->with('error', 'Add a Category First');
    }
}
