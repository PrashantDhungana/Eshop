<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\AdminProductController as Admin;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
 
// Route::get('/',[ProductController::class,'index']);
// Route::get('/product/create',[ProductController::class,'create']);
// Route::get('/product/{slug}',[ProductController::class,'show']);
// Route::post('/product/create',[ProductController::class,'store'])->name('store.product');
Route::resource('product', ProductController::class)->except([
    'create', 'store', 'update', 'destroy'
]);;

// For Admin 

Route::resource('admin/products',App\Http\Controllers\Admin\ProductController::class)->except(
    'show');

Route::get('/dashboard',[App\Http\Controllers\Admin\ProductController::class,'dashboard']);

