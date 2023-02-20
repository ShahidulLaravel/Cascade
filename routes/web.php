<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DeleteController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\UpdateProdcutController;

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

Route::get('/sub_category/delete/{delete_id}', [SubCategoryController::class, 'subcategory_delete'])->name('subcategory.delete');

Route::get('/sub_category/edit/{edit_id}', [SubCategoryController::class, 'subcategory_edit'])->name('subcategory.edit');

Route::get('/subcategory/trash/', [SubCategoryController::class, 'subcategory_trash'])->name('subcategory.trash');

Route::get('/subcategory/restore/{restore_id}', [SubCategoryController::class, 'subcategory_restore'])->name('subcategory.restore');

Route::post('/subcategory/restore_all/', [SubCategoryController::class, 'subcategory_restore_all'])->name('subcategory.restore_all');

Route::get('/subcategory/delete_all/{delete_id}', [SubCategoryController::class, 'subcategory_delete_single'])->name('subcategorysingel.delete');

Route::post('/subcategory/update', [SubCategoryController::class, 'subcategory_update'])->name('subcategory.update');

//product brand

Route::get('/brands', [BrandController::class, 'brand'])->name('brands');

Route::post('/brands/insert', [BrandController::class, 'brand_insert'])->name('brand.insert');


//add product
Route::get('/add/product', [ProductController::class, 'add_product'])->name('add.product');

Route::get('/show/product', [ProductController::class, 'show_product'])->name('show.product');

Route::post('/getSubcategory', [ProductController::class, 'getSubcategory']);
Route::post('/product/store', [ProductController::class, 'insert_product'])->name('product.insert');

Route::get('/product/edit/{product_id}', [ProductController::class, 'edit_product'])->name('edit.product');

Route::post('/product/update', [UpdateProdcutController::class, 'update_product'])->name('product.update');


// product inventory and variation

Route::get('/porduct/variation', [InventoryController::class, 'add_inventory'])->name('product.variation');

Route::post('/porduct/variation/insert', [InventoryController::class, 'variation_store'])->name('product.store');


//inventory

Route::get('/inventory/add/{inventory_add}', [InventoryController::class, 'add_invetory'])->name('product.inventory');

Route::post('/inventory/store/', [InventoryController::class, 'inventory_store'])->name('inventory.store');

// deleted task

Route::get('/inventory/delete/{delete_id}', [InventoryController::class, 'inventory_delete'])->name('inventory.delete');

Route::get('/colors/delete/{delete_id_colors}', [InventoryController::class, 'colors_delete'])->name('colors_delete');

Route::get('/size/delete/{delete_id_size}', [InventoryController::class, 'size_delete'])->name('size.delete');

Route::get('/brand/delete/{delete_id_brand}', [InventoryController::class, 'brand_delete'])->name('brand.delete');

Route::get('/product/delete/{delete_id_product}', [InventoryController::class, 'product_delete'])->name('product.delete');


// single page show

Route::get('/product/details/{product_id}', [FrontEndController::class, 'details'])->name('details');

Route::post('/getSize', [FrontEndController::class, 'getSize']);

Route::post('add/cart', [ProductController::class, 'add_cart'])->name('add_cart');


// Customer controller

Route::get('/customer/Authentication', [CustomerController::class, 'customer_reg_log'])->name('customer.register.login');

Route::post('/customer/registration', [CustomerController::class, 'customer_registration'])->name('customer.register.store');

Route::post('/customer/login', [CustomerController::class, 'customer_login'])->name('customer.login');

Route::get('/customer/logout', [CustomerController::class, 'customer_logout'])->name('customer.logout');

Route::get('/customer/profile', [CustomerController::class, 'customer_profile'])->name('customer.profile');

Route::post('/customer/information/update',[CustomerController::class, 'customer_profile_update'])->name('customer_info.update');






