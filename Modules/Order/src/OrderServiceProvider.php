<?php 

namespace Topdot\Order;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Topdot\Order\Http\Livewire\OrderStatusComponent;
use Topdot\Order\Http\Livewire\OrderTableComponent;
use Topdot\Order\Http\Livewire\OrderTrackingComponent;
use Topdot\Order\OrderRoutes;

class OrderServiceProvider extends ServiceProvider
{
    public $routeFilePath = '/routes';
    public $publishedViewPath = '/views/admin/order';
    public $configPath = '/config/orders.php';

    public function boot()
    {
        $this->setUpRoutes();
        $this->setUpConfig();
        $this->setUpViews();

        if ( $this->app->runningInConsole() ){
            $this->publishAssets();
        }

        Livewire::component('order::order-table-component',OrderTableComponent::class);
        Livewire::component('order::order-status-component',OrderStatusComponent::class);
        Livewire::component('order::order-tracking-component',OrderTrackingComponent::class);

    }

    private function setUpRoutes()
    {
        Route::mixin(new OrderRoutes);

        $this->app->bind('orderRoutes',function(){
            return new OrderRoutes;
        });
    }

    private function setUpViews()
    {
        $this->loadViewsFrom([
            resource_path($this->publishedViewPath),
            __DIR__.('/resources/views')
        ],'order');
    }

    private function setUpConfig()
    {
        $this->mergeConfigFrom( __DIR__.$this->configPath, 'order');
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