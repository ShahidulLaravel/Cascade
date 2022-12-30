<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function users(){
        $users = User::all();
        return view('admin.users.users', compact('users'));
    }
    public function edit(User $user){
        return view('admin.users.edit', compact('user'));
    }
    public function update(Request $request, User $user){

        $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'email' => 'required|email|unique:users,email,'. $user->id,
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        return redirect()->route('users')->with('success', 'User Info updated Successfully');
        
    }
    public function delete(User $user){
        return back()->with('success', 'User Deleted Successfully');
    }
}
