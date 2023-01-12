<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\SubCategoryController;

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
Route::get('/category/delete/{category_id}', [CategoryController::class, 'delete_category'])->name('category.delete');

Route::get('/category/edit/{category_edit_id}', [CategoryController::class, 'edit_category'])->name('category.edit');

Route::post('/category/update/', [CategoryController::class, 'update_category'])->name('category.update');

Route::get('/category/trash/', [CategoryController::class, 'category_trash'])->name('category.trash');

Route::get('/category/restore_single/{user_id}', [CategoryController::class, 'category_restore_single'])->name('category.restore_single');

Route::get('/category/delete_permanent/{user_id}', [CategoryController::class, 'category_perDelete_single'])->name('category.perDel_single');

Route::post('/category/restore_all/', [CategoryController::class, 'category_restoreAll'])->name('category.restore_all');

//add subcategory

Route::get('/add/sub_category/', [SubCategoryController::class, 'subcategory'])->name('subcategory');

Route::post('/sub_category/store', [SubCategoryController::class, 'subcategory_insert'])->name('subcategory.insert');







