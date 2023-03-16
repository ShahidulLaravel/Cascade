<?php

namespace App\Http\Controllers;

use App\Models\Logo;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function admin_logout(){
        Auth::logout();
        return redirect('/login');
    }

    public function add_logo(){
        return view('admin.logo.add');
    }

    public function store_logo(Request $request){
        $product_brand = $request->logo;
        $extension = $product_brand->getClientOriginalExtension();
        $file_name = Str::lower(str_replace(' ', '-', 'kumo-logo')) . '-' . rand(10, 10000) . '.' . $extension;

        Image::make($product_brand)->save(public_path('uploads/Logo/' . $file_name));
        Logo::insert([
            'logo' => $file_name,
        ]);
        return back();
    }
}
