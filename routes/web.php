<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FrontEndController;

//For Auth
Auth::routes();

//Front end Controller
Route::get('/', [FrontEndController::class, 'frontEnd'])->name('frontEnd');

// Backend / Dashboard Controller
Route::get('/home', [HomeController::class, 'index'])->name('home');


// user maintain Controller
Route::get('users/', [UserController::class, 'users'])->name('users')->middleware();
Route::get('users/delete/{user_id}', [UserController::class, 'delete'])->name('user.delete');
Route::get('users/edit_profile/', [UserController::class, 'edit_profile'])->name('edit.profile');
Route::post('users/update_info/', [UserController::class, 'update_info'])->name('update.info');
Route::post('users/update_password/', [UserController::class, 'update_password'])->name('update.password');
Route::post('users/update_image/', [UserController::class, 'update_image'])->name('update.image');

// catrgory controller

Route::get('/category', [CategoryController::class, 'category'])->name('category');
Route::post('/category/sort', [CategoryController::class, 'add_category'])->name('category.sort');





