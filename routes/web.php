<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RazorpayController;

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

Route::get('/login', function () {
    return view('login');
});

Route::post('/login', [UserController::class, 'login']);
Route::get('/', [ProductController::class, 'index']);
Route::get('/product/{id}', [ProductController::class, 'detail']);
Route::get('/search', [ProductController::class, 'search']);
Route::post('/add_to_cart', [ProductController::class, 'add_to_cart']);
Route::get('/cart', [ProductController::class, 'showCartData']);
Route::get('/logout', function () {
    Session::forget('user');
    return redirect('login');
});

Route::get('/delete/{id}', [ProductController::class, 'deleteCartItem']);
Route::get('/checkout', [ProductController::class, 'ordernow']);
Route::get('/profile', [ProfileController::class, 'profile']);
Route::put('/update', [ProfileController::class, 'update']);
Route::get('razorpay', [RazorpayController::class, 'razorpay'])->name(
    'razorpay'
);
Route::post('razorpaypayment', [RazorpayController::class, 'payment'])->name(
    'payment'
);

Route::get('privacy', function () {
    return view('privacy');
});

Route::get('payment_done', function () {
    return view('payment_done');
});

Route::get('/register', function () {
    return view('register');
});
Route::post('register', [UserController::class, 'register']);
