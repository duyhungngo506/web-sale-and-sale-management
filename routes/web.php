<?php

use App\Http\Controllers\BillController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\TypeProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoucherController;
use App\Models\Bill;
use App\Models\Slide;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

//adminLogin
Route::get('admin/login', function () {
    return view('admin.login');
})->middleware('adminLogin');

 //client
Route::group(['middleware'=>'client'],function(){
    Route::get('/', [ProductController::class,'index'])->name('home');

    Route::get('products/{id}',[ProductController::class,'show']);
    
    Route::get('/type/{id?}/{typename?}',[ProductController::class,'typeProduct'])->name('products.type');
    Route::get('/about', function(){
        return view('product.about');
    })->name('about');
    
    Route::get('contact', function(){
        return view('product.contact');
    })->name('contact');
    //add to cart
    Route::get('add-to-cart/{id}',[PageController::class,'addToCart'])->name('addToCart');
    //del-cart-item
    Route::get('del-cart/{id}',[PageController::class,'delCartItem'])->name('delCartItem');
    
    Route::get('shoppingcart', function () {
        return view('product.shopping_cart');
    })->name('shoppingcart');

    Route::get('minus/{id}', [PageController::class,'reduceOne'])->name('reduceOne');
    Route::get('plus/{id}', [PageController::class,'RaiseOne'])->name('RaiseOne');
});

//customer
Route::group(['middleware'=>'customer'],function(){ 
    Route::get('checkout', function () {
        return view('product.checkout');
    })->name('checkout');
    Route::post('order',[PageController::class,'postCheckout'])->name('order');
    Route::get('change-wishlist/{id}', [PageController::class,'changeWishlist'])->name('changeWishlist');
    Route::get('wishlist', function(){
        return view('product.wishlist');
    })->name('wishlist');

    Route::post('apply-voucher',[PageController::class,'applyVoucher'])->name('apply-voucher');

});

//admin
Route::group(['middleware'=>'admin'],function(){
    
    Route::get('admin',[UserController::class,'index'])->name('admin');
    Route::get('admin/products', function(){
        return view('admin.product-list');
    })->name('admin.products');
    Route::resource('products', ProductController::class);
    Route::resource('orders', BillController::class);
    Route::resource('typeproducts', TypeProductController::class);
    Route::resource('slides', SlideController::class);
    Route::resource('vouchers', VoucherController::class);

    Route::get('cancel/{id}',[BillController::class,'cancelOrder'])->name('cancel');
    Route::get('delivery/{id}',[BillController::class,'deliveryOrder'])->name('delivery');
    Route::get('success/{id}',[BillController::class,'successOrder'])->name('success');
    Route::get('failed/{id}',[BillController::class,'failedOrder'])->name('failed');
});

Route::resource('users', UserController::class)->middleware('admin');

//mail
Route::get('/input-email', function(){
    return view('product.input-email');
})->name('getInputEmail');
Route::post('/input-email',[PageController::class,'postInputEmail'])->name('postInputEmail');