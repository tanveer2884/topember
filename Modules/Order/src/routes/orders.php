<?php 

use Illuminate\Support\Facades\Route;
use Topdot\Order\Http\Controllers\OrderController;

Route::resource('orders', OrderController::class)->only('show','index');