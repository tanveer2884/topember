<?php 

use Topdot\Cms\Facades\CmsRoutes;
use Topdot\Core\Facades\CoreRoutes;
use Illuminate\Support\Facades\Route;
use Topdot\Order\Facades\OrderRoutes;
use Topdot\Coupon\Facades\CouponRoutes;
use Topdot\Product\Facades\ProductRoutes;
use Topdot\Category\Facades\CategoryRoutes;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ManufactureController;
use App\Http\Controllers\Admin\TestimonialController;

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index')->middleware('auth');

Route::middleware(['permission.check'])->group(function(){

    CmsRoutes::register();
    CouponRoutes::register();
    CoreRoutes::register();
    CategoryRoutes::register();
    ProductRoutes::register();
    OrderRoutes::register();

    Route::resource('faqs',FaqController::class)->except('show','destroy');
    Route::resource('testimonials',TestimonialController::class)->except('show','destroy');
    Route::resource('manufacturers', ManufactureController::class);
});