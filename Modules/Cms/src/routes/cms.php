<?php 

use Illuminate\Support\Facades\Route;
use Topdot\Cms\Http\Controllers\PageController;
use Topdot\Cms\Http\Controllers\PageEditorController;

Route::resource('pages', PageController::class);
Route::get('page-customize/{page}', [PageEditorController::class, 'index'])->name('page-customize.index');
Route::post('page-customize/{page}', [PageEditorController::class, 'store'])->name('page-customize.store');
Route::get('page-customize/{page}/templates', [PageEditorController::class, 'templates'])->name('page-customize.templates');
