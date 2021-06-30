<?php 

use Illuminate\Support\Facades\Route;
use Topdot\Product\Http\Controllers\ProductController;
use Topdot\Product\Http\Controllers\AttributesController;
use Topdot\Product\Http\Controllers\AttributeValuesController;
use Topdot\Product\Http\Controllers\ProductAttributesController;

Route::resource('products', ProductController::class)->except('show','destroy');
Route::resource('attributes', AttributesController::class)->except('show','destroy');
Route::resource('attributes.values', AttributeValuesController::class)->only('index');
Route::resource('product.attributes', ProductAttributesController::class)->only('index');