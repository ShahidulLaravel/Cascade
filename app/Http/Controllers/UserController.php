<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserPassUpdate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;


class UserController extends Controller
{
    public function users(){
        $users = User::all();
        return view('admin.users.users', compact('users'));
    }
    
    public function delete($user_id){
        User::find($user_id)->delete();
        return back()->with('success', 'User Deleted Successfully');
    }

    public function edit_profile(){
        return view('admin.users.edit_profile');
    }

    function update_info(Request $request){
        
        User::find(Auth::id())->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        return back()->with('success', 'User Info Updated Successfully');
    }

    function update_password(UserPassUpdate $request){
        if(Hash::check($request->old_password, Auth::user()->password)){
            User::find(Auth::id())->update([
                'password' => bcrypt($request->password),
            ]);
            return back()->with('pass_success', 'Password Change Successfully');
        }
        else{
            return back()->with('old_password', 'Old Password Doesnot Matched');
        }
    }
}
