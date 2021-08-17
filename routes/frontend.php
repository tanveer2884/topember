<?php

use App\Http\Controllers\Frontend\CategoryProductController;
use App\Http\Controllers\Frontend\PageController;
use Illuminate\Support\Facades\Route;

Route::get('b/{categoryOrProductSlug}', CategoryProductController::class)->name('product-category-route');

Route::any('/{page}', PageController::class)->where('page', '.*');