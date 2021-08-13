<?php 

use Topdot\Core\Facades\CoreRoutes;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use Topdot\Category\Facades\CategoryRoutes;
use Topdot\Cms\Facades\CmsRoutes;
use Topdot\Coupon\Facades\CouponRoutes;
use Topdot\Order\Facades\OrderRoutes;
use Topdot\Product\Facades\ProductRoutes;

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index')->middleware('auth');

Route::middleware(['permission.check'])->group(function(){

    CmsRoutes::register();
    CouponRoutes::register();
    CoreRoutes::register();
    CategoryRoutes::register();
    ProductRoutes::register();
    OrderRoutes::register();

});