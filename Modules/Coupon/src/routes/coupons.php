<?php 

use Illuminate\Support\Facades\Route;
use Topdot\Coupon\Http\Controllers\CouponController;

Route::resource('coupons', CouponController::class)->except('show','destroy');