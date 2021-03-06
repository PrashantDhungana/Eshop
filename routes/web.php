<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\OrderItemController;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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

//For Search
Route::get('/search',[ProductController::class,'search']);


// Normal Product view for Users
Route::resource('product', ProductController::class)->except([
    'create', 'store', 'update', 'destroy'
]);;

// Rating Route
Route::post('/rating/{slug}',[RatingController::class,'store']);
Route::post('/rating/{id}/edit',[RatingController::class,'update']);

//For Shoppping Cart
Route::delete('/cart/{id}',[OrderItemController::class,'destroy'])->name('cart.destroy')->middleware('auth');
Route::post('/cart',[OrderItemController::class,'store'])->name('cart.store')->middleware('auth');
Route::get('/cart',[OrderItemController::class,'index'])->name('cart.index')->middleware('auth');

// Product Checkout
Route::get('checkout',[App\Http\Controllers\CheckoutController::class,'index'])->name('cart.checkout')->middleware('auth');
Route::post('checkout',[App\Http\Controllers\CheckoutController::class,'store'])->name('checkout.store')->middleware('auth');



//Login 
Route::get('/login',[LoginController::class,'login']);
Route::post('/login',[LoginController::class,'authenticate'])->name('login');
Route::get('/logout',[LoginController::class,'logout']);

//Register
Route::get('/register',[RegisterController::class,'create']);
Route::post('/register',[RegisterController::class,'store'])->name('register');

// For Admin 
Route::middleware(['auth'])->group(function () {
    // For Admin 
    Route::resource('admin/products',App\Http\Controllers\Admin\ProductController::class)->except(
    'show');

    Route::resource('admin/categories',App\Http\Controllers\Admin\CategoryController::class)->except(
        'show');

    Route::resource('/admin/order', App\Http\Controllers\OrderController::class);

    Route::get('/dashboard',[App\Http\Controllers\Admin\ProductController::class,'dashboard']);

    Route::resource('/admin/report', App\Http\Controllers\Admin\ReportController::class);
});

// Sending a Mail
// Route::get('send-mail', function () {
//     \Illuminate\Support\Facades\Mail::to('sharma.prashant2000@gmail.com')->send(new App\Mail\KarishmaMail);
// });

// Email Verification
Route::get('verify/{token}',[App\Http\Controllers\Auth\RegisterController::class,'VerifyToken']);
Route::get('resend/{id}',[App\Http\Controllers\Auth\RegisterController::class,'resendMail'])->name('resend.mail');

//Social Login
Route::get('login/github',[App\Http\Controllers\Auth\LoginController::class,'SocialRedirect']);
Route::get('login/github/redirect',[App\Http\Controllers\Auth\LoginController::class,'SocialCallback']);

//OTP route
Route::get('sms',[App\Http\Controllers\SmsController::class,'sendMessage']);

