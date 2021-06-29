<?php 

use Illuminate\Support\Facades\Route;
use Topdot\Core\Http\Controllers\MediaController;

Route::get('media/{media}', [MediaController::class, 'show'])->name('api.medias.show');
Route::post('media/tinymce', [MediaController::class, 'tinyMce'])->name('api.tinymce.medias.store');
