<?php

use Topdot\Menu\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Route;
use Topdot\Menu\Http\Controllers\MenuBuilderController;

Route::get('menus',MenuController::class)->name('menus.index');
Route::get('menus/{menu}/builder',MenuBuilderController::class)->name('menus.builder');