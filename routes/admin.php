<?php 

use Topdot\Core\Facades\CoreRoutes;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use Topdot\Category\Facades\CategoryRoutes;
use Topdot\Order\Facades\OrderRoutes;
use Topdot\Product\Facades\ProductRoutes;

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

Route::middleware(['permission.check'])->group(function(){

    CoreRoutes::register();
    CategoryRoutes::register();
    ProductRoutes::register();
    OrderRoutes::register();

});