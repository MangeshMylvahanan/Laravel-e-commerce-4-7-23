<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
//admin
Route::get('/admin',[UserController::class,'Admin'])->middleware('auth');
Route::get('/viewproducts',[AdminController::class,'viewProducts'])->middleware('auth');
Route::get('/users',[AdminController::class,'Users'])->middleware('auth');
Route::get('/viewpayments',[AdminController::class,'Payments'])->middleware('auth');
Route::get('/newsellerregister',[AdminController::class,'NewSellerRegister'])->middleware('auth');
Route::get('/addseller',[AdminController::class,'AddSeller'])->middleware('auth')->name('add-seller');
Route::get('/removeseller',[AdminController::class,'RemoveSeller'])->middleware('auth')->name('remove-seller');


//user login,logout,register,forgot password
Route::view('/login',('Auth.login'))->middleware('guest')->name('login');
Route::post('/login',[UserController::class,'Authenticate']);
Route::get('login/google',[UserController::class,'GoogleRedirect']);
Route::get('login/google/callback',[UserController::class,'LoginWithGoogle']);
Route::get('/logout',[UserController::class,'logout']);
Route::get('/userregister',[UserController::class,'UserRegister'])->name('userregister');
Route::post('/userregister',[UserController::class,'UserRegisterStore']);

//Products page, cart, checkout
Route::get('/',[ProductController::class,'home']);
Route::get('/shop',[ProductController::class,'viewshop']);
Route::get('productdetail/{id}',[ProductController::class,'details'])->name('product_detail');



//seller register
Route::get('/sellerregister',[UserController::class,'SellerRegister'])->name('sellerregister');
Route::post('/sellerregister',[UserController::class,'SellerRegisterStore'])->name('sellerregisterStore');
Route::get('/waitinglist',[UserController::class,'Waitlist']);

//products add
Route::get('/productsadd',[ProductController::class,'AddProduct'])->middleware('auth');
Route::post('/store',[ProductController::class,'AddProductStore']);

//cart
Route::post('/add_to_cart',[CartController::class,'addtocart'])->middleware('auth')->name('add_to_cart');
Route::get('/cartlist',[CartController::class,'CartList'])->middleware('auth')->name('cart');
Route::post('/removecart/{id}',[CartController::class,'removeCart'])->name('remove_cart');
Route::get('/checkout',[CartController::class,'CheckOut'])->middleware('auth')->name('checkout');
//razorpay
Route::post('/pay', [PaymentController::class, 'store'])->name('PayStore');
Route::get('/payment', [PaymentController::class, 'Index'])->name('RazorPay');
Route::post('payment', [PaymentController::class, 'RazorPayStore'])->name('RazorPayStore');
Route::get('/invoice',[PaymentController::class,'Invoice'])->name('invoice');
//search
Route::get('/search', [ProductController::class, 'searchProducts'])->name('searchProducts');

