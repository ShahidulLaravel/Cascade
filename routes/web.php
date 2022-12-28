<?php

use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

//For Auth
Auth::routes();

//Front end Controller
Route::get('/', [FrontEndController::class, 'frontEnd'])->name('frontEnd');

// Backend / Dashboard Controller
Route::get('/home', [HomeController::class, 'index'])->name('home');


// user maintain Controller


