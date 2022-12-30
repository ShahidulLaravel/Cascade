<?php

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
Route::get('users/', [UserController::class, 'users'])->name('users');

//user Route grouping

Route::controller(UserController::class)->prefix('user')->name('user.')->group(function(){

    Route::get('/edit/{user}', 'edit')->name('edit');
    Route::put('/update/{user}', 'update')->name('update');
    Route::delete('/delete/{user}','delete')->name('delete');
});




