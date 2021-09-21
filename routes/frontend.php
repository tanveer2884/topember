<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\Cart\CartController;
use App\Http\Controllers\Frontend\Auth\LoginController;
use App\Http\Controllers\Frontend\Auth\RegisterController;
use App\Http\Controllers\Frontend\Account\ProfileController;
use App\Http\Controllers\Frontend\CategoryProductController;
use App\Http\Controllers\Frontend\Account\PasswordController;
use App\Http\Controllers\Frontend\Auth\PasswordResetController;
use App\Http\Controllers\Frontend\Auth\ForgotPasswordController;
use App\Http\Controllers\Frontend\Account\AddressBookController;
use App\Http\Controllers\Frontend\Account\PaymentController;
use App\Http\Controllers\Frontend\Account\OrderController;
use App\Http\Controllers\Frontend\Cart\CheckoutController;
use App\Http\Controllers\Frontend\Cart\OrderConfirmationController;
use App\Http\Controllers\Frontend\Cart\ThankuController;

// Route::get('products/{categoryOrProductSlug?}', CategoryProductController::class)->name('product.index');

// Route::get('cart',CartController::class)->name('cart');

// Route::get('checkout',[CheckoutController::class,'index'])->name('checkout');
// Route::post('checkout',[CheckoutController::class,'store'])->name('checkout.store');

// Route::get('confirm-order',[OrderConfirmationController::class,'index'])->name('confirm-order');
// Route::post('confirm-order',[OrderConfirmationController::class,'store'])->name('confirm-order.store');
// Route::get('thank-you',ThankuController::class)->name('thank-you');
/**
 * Authenticated Routes Only
 */

// Route::middleware('guestCustomer')->as('user.')->group(function(){
//     Route::get('login',LoginController::class)->name('login');
//     Route::get('register',RegisterController::class)->name('register');
//     Route::get('forgot-password',ForgotPasswordController::class)->name('forgot-password');
//     Route::get('reset-password/{token}',PasswordResetController::class)->name('reset-password');
// });


// Route::middleware('auth')->as('user.')->group(function(){
//     Route::post('logout',[LoginController::class, 'logout'])->name('logout');

//     Route::get('my-account',ProfileController::class)->name('my-account');
//     Route::get('update-password',PasswordController::class)->name('update-password');
//     Route::resource('addresses',AddressBookController::class)->only(['index','create','edit']);
//     // Route::get('notifications',NotificationController::class)->name('notifications');
//     Route::resource('payments',PaymentController::class)->only(['index','create']);
//     Route::resource('orders',OrderController::class)->only(['index','show']);

// });

// Route::get('payment',[PaymentController::class, 'payment'])->name('payment');

// Route::any('/{page}', PageController::class)->where('page', '.*');
Route::any('/{page?}', function(){
    return redirect()->route('login');
})->where('page', '.*');