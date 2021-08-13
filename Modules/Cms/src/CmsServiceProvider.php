<?php 

namespace Topdot\Cms;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Topdot\Cms\Http\Livewire\TableComponent;

class CmsServiceProvider extends ServiceProvider
{
    public $routeFilePath = '/routes';
    public $publishedViewPath = '/views/admin/cms';
    public $configPath = '/config/cms.php';

    public function boot()
    {
        $this->setUpRoutes();
        $this->setUpConfig();
        $this->setUpViews();

        if ( $this->app->runningInConsole() ){
            $this->publishAssets();
        }

        Livewire::component('cms::table-component', TableComponent::class);

    }

    private function setUpRoutes()
    {
        Route::mixin(new CmsRoutes);

        $this->app->bind('cmsRoutes',function(){
            return new CmsRoutes;
        });
    }

    private function setUpViews()
    {
        $this->loadViewsFrom([
            resource_path($this->publishedViewPath),
            __DIR__.('/resources/views')
        ],'cms');
    }

    private function setUpConfig()
    {
        $this->mergeConfigFrom( __DIR__.$this->configPath, 'cms');
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