<?php

namespace Topdot\Core;

use Illuminate\Routing\Router;
use Livewire\Livewire;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Topdot\Core\Http\Livewire\SlugGenerator;
use Topdot\Core\Http\Livewire\TableComponent;
use Topdot\Core\Commands\DefaultAdminUserMaker;
use Topdot\Core\Http\Livewire\ImagePreviewComponent;
use Topdot\Core\Http\Livewire\StatusToggleComponent;
use Topdot\Core\Http\Livewire\TempFileUploadComponent;
use Topdot\Core\Http\Middleware\CheckUserPermission;
use Topdot\Core\Http\Livewire\ManufactureTableComponent;

class CoreServiceProvider extends ServiceProvider
{
    public $routeFilePath = '/routes';
    public $publishedViewPath = '/views/admin/core';
    public $configPath = '/config/core.php';

    public function boot(Router $router)
    {
        $this->setUpRoutes();
        $this->setUpConfig();
        $this->setUpViews();
        $this->setUpLiveWireComponents();
        $this->registerCommands();
        $router->aliasMiddleware('permission.check', CheckUserPermission::class);

        if ( $this->app->runningInConsole() ){
            $this->publishAssets();
        }
    }

    private function registerCommands()
    {
        $this->commands([
            DefaultAdminUserMaker::class
        ]);
    }

    private function setUpLiveWireComponents()
    {
        Livewire::component('core::user-table-component',TableComponent::class);
        Livewire::component('status-toggle-component',StatusToggleComponent::class);
        Livewire::component('slug-generator',SlugGenerator::class);
        Livewire::component('temp-file-upload-component',TempFileUploadComponent::class);
        Livewire::component('image-preview-component',ImagePreviewComponent::class);
        Livewire::component('manufacture-table-component',ManufactureTableComponent::class);
    }

    private function setUpRoutes()
    {
        Route::mixin(new CoreRoutes);

        $this->app->bind('coreRoutes',function(){
            return new CoreRoutes;
        });
    }

    private function setUpViews()
    {
        $this->loadViewsFrom([
            resource_path($this->publishedViewPath),
            __DIR__.('/resources/views')
        ],'core');
    }

    private function setUpConfig()
    {
        $this->mergeConfigFrom( __DIR__.$this->configPath, 'core');
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
