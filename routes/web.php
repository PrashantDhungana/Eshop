<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\RatingController;
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

Route::get('/', function () {
    return view('welcome');
});
 
// Route::get('/',[ProductController::class,'index']);
// Route::get('/product/create',[ProductController::class,'create']);
// Route::get('/product/{slug}',[ProductController::class,'show']);
// Route::post('/product/create',[ProductController::class,'store'])->name('store.product');

// Normal Product view for Users
Route::resource('product', ProductController::class)->except([
    'create', 'store', 'update', 'destroy'
]);;

// Rating Route
Route::post('/rating/{slug}',[RatingController::class,'store']);
Route::post('/rating/{id}/edit',[RatingController::class,'update']);


//Login 
Route::get('/login',[LoginController::class,'login']);
Route::post('/login',[LoginController::class,'authenticate'])->name('login');
Route::get('/logout',[LoginController::class,'logout']);

//Register
Route::get('/register',[RegisterController::class,'create']);
Route::post('/register',[RegisterController::class,'store'])->name('register');

Route::middleware(['auth'])->group(function () {
    // For Admin 
    Route::resource('admin/products',App\Http\Controllers\Admin\ProductController::class)->except(
    'show');

    Route::resource('admin/categories',App\Http\Controllers\Admin\CategoryController::class)->except(
        'show');

    Route::get('/dashboard',[App\Http\Controllers\Admin\ProductController::class,'dashboard']);
});