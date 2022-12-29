<?php

use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//For Auth
Auth::routes();

//Front end Controller
Route::get('/', [FrontEndController::class, 'frontEnd'])->name('frontEnd');

// Backend / Dashboard Controller
Route::get('/home', [HomeController::class, 'index'])->name('home');


// user maintain Controller
Route::get('users/', [UserController::class, 'users'])->name('users');

Route::get('user/edit/{edit_id}', [UserController::class, 'edit'])->name('user.edit');

Route::put('user/update/{update_id}', [UserController::class, 'update'])->name('user.update');

Route::get('user/delete/{delete_id}', [UserController::class, 'delete'])->name('user.delete');


