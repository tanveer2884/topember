<?php 

namespace Topdot\Coupon;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Topdot\Coupon\Http\Livewire\TableComponent;

class CouponServiceProvider extends ServiceProvider
{
    public $routeFilePath = '/routes';
    public $publishedViewPath = '/views/admin/coupon';
    public $configPath = '/config/coupons.php';

    public function boot()
    {
        $this->setUpRoutes();
        $this->setUpConfig();
        $this->setUpViews();

        if ( $this->app->runningInConsole() ){
            $this->publishAssets();
        }

        Livewire::component('coupon::table-component', TableComponent::class);
    }

    private function setUpRoutes()
    {
        Route::mixin(new CouponRoutes);

        $this->app->bind('couponRoutes',function(){
            return new CouponRoutes;
        });
    }

    private function setUpViews()
    {
        $this->loadViewsFrom([
            resource_path($this->publishedViewPath),
            __DIR__.('/resources/views')
        ],'coupon');
    }

    private function setUpConfig()
    {
        $this->mergeConfigFrom( __DIR__.$this->configPath, 'coupon');
    }

    private function publishAssets()
    {
        $this->publishes([
            __DIR__.'/resources/views' => resource_path($this->publishedViewPath),
        ],'views');

        $this->publishes([
            __DIR__.'/routes' => base_path($this->routeFilePath),
        ],'routes');

        $this->publishes([
            __DIR__.$this->configPath => base_path( $this->configPath ),
        ],'config');

        $this->publishes([
            __DIR__.'/database/migrations' => database_path( 'migrations' ),
        ],'migrations');
    }
}