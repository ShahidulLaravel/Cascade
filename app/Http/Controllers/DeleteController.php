<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Colors;
use App\Models\InventoryStore;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    public function delete_execute($delete_id){
        InventoryStore::where('id', $delete_id)->delete();
        Colors::where('id', $delete_id)->delete();
        Size::where('id', $delete_id)->delete();
        Brand::where('id', $delete_id)->delete();
        Product::where('id', $delete_id)->delete();
        return back()->with('success', 'Deleted Successfully');
    }
    
}
