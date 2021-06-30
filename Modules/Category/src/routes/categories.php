<?php 

use Illuminate\Support\Facades\Route;
use Topdot\Category\Http\Controllers\CategoryController;

Route::resource('categories', CategoryController::class);