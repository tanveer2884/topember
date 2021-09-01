<?php

use Illuminate\Support\Facades\Route;
use Topdot\Core\Http\Controllers\RoleController;
use Topdot\Core\Http\Controllers\UserController;
use Topdot\Core\Http\Controllers\ProfileController;
use Topdot\Core\Http\Controllers\SettingsController;
use Topdot\Core\Http\Controllers\UserRoleController;
use Topdot\Core\Http\Controllers\UserCsvExportController;
use Topdot\Core\Http\Controllers\RolePermissionController;
use Topdot\Core\Http\Controllers\UserImportController;
use Topdot\Core\Http\Controllers\ManufactureController;

Route::resource('settings', SettingsController::class)->only('index','store');
Route::resource('profile', ProfileController::class)->only('index', 'store');

Route::resource('roles', RoleController::class);
Route::resource('roles.permissions', RolePermissionController::class)->only('index', 'store');
Route::resource('users', UserController::class);
Route::resource('import-users', UserImportController::class)->only('index','store');
Route::resource('users.roles', UserRoleController::class)->only('index', 'store');
Route::get('users/export/csv', UserCsvExportController::class)->name('users.export.csv');
Route::get('samplefile', [UserImportController::class,'download'])->name('samplefile');
Route::get('errors-file', [UserImportController::class,'downloadErrors'])->name('errors-file');
