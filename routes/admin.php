<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Cms\Page\PageShowController;
use App\Livewire\Admin\Cms\Menu\MenuIndexController;
use App\Livewire\Admin\Cms\Page\PageIndexController;
use App\Livewire\Admin\Cms\Page\PageCreateController;
use App\Livewire\Admin\Dashboard\DashboardController;
use App\Livewire\Admin\Cms\Menu\MenuBuilderController;
use App\Livewire\Admin\Profile\StaffProfileController;
use App\Http\Controllers\Admin\Cms\PageEditorController;
use App\Livewire\Admin\System\Staff\StaffShowController;
use App\Livewire\Admin\Cms\Members\MemberIndexController;
use App\Livewire\Admin\System\Staff\StaffIndexController;
use App\Livewire\Admin\Cms\Members\MemberCreateController;
use App\Livewire\Admin\Cms\Members\MemberShowController;
use App\Livewire\Admin\Cms\Projects\ProjectCreateController;
use App\Livewire\Admin\Cms\Projects\ProjectIndexController;
use App\Livewire\Admin\Cms\Projects\ProjectShowController;
use App\Livewire\Admin\System\Settings\SettingsController;
use App\Livewire\Admin\System\Staff\StaffCreateController;

Route::middleware('auth:admin')->group(function () {

    Route::get('dashboard', DashboardController::class)->name('dashboard');

    Route::prefix('cms')->middleware('permission:cms')->as('cms.')->group(function () {

        Route::middleware('permission:cms:manage-menus')->group(function () {
            Route::get('menus', MenuIndexController::class)->name('menu.index');
            Route::get('menus/{menu}/builder', MenuBuilderController::class)->name('menu.builder');
        });

        Route::middleware('permission:cms:manage-pages')->group(function () {
            Route::get('pages', PageIndexController::class)->name('pages.index');
            Route::get('pages/create', PageCreateController::class)->name('pages.create');
            Route::get('pages/{page}', PageShowController::class)->name('pages.show');
            Route::get('pages/{page}/editor', [PageEditorController::class, 'editor'])->name('pages.editor');
        });

        Route::middleware('permission:cms:manage-members')->group(function () {
            Route::get('members', MemberIndexController::class)->name('members.index');
            Route::get('member/create', MemberCreateController::class)->name('members.create');
            Route::get('member/{member}', MemberShowController::class)->name('members.show');
        });

        Route::middleware('permission:cms:manage-projects')->group(function () {
            Route::get('projects', ProjectIndexController::class)->name('projects.index');
            Route::get('projects/create', ProjectCreateController::class)->name('projects.create');
            Route::get('projects/{project}', ProjectShowController::class)->name('projects.show');
        });

    });

    Route::prefix('system')->middleware('permission:system')->as('system.')->group(function () {

        Route::middleware('permission:system:manage-staff')->group(function () {
            Route::get('staff', StaffIndexController::class)->name('staff.index');
            Route::get('staff/create', StaffCreateController::class)->name('staff.create');
            Route::get('staff/{staff}', StaffShowController::class)->name('staff.show');
        });

        Route::middleware('permission:system:settings')->group(function () {
            Route::get('settings', SettingsController::class)->name('settings');
        });

    });

    Route::get('staff/account', StaffProfileController::class)->name('staff.profile');

});
