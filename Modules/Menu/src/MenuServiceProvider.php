<?php

namespace Topdot\Menu;

use Topdot\Menu\Http\Livewire\CreateEditMenu;
use Livewire\Livewire;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Topdot\Menu\Http\Livewire\CreateEditMenuItem;
use Topdot\Menu\Http\Livewire\MenuBuilder;
use Topdot\Menu\Http\Livewire\MenuTableComponent;

class MenuServiceProvider extends ServiceProvider
{
    public $routeFilePath = '/routes';
    public $publishedViewPath = '/views/admin/menu';
    public $configPath = '/config/menu.php';

    public function boot()
    {
        $this->setUpRoutes();
        $this->setUpConfig();
        $this->setUpViews();
        $this->setUpMigrations();

        if ( $this->app->runningInConsole() ){
            $this->publishAssets();
        }

        Livewire::component('menu::create-edit-menu',CreateEditMenu::class);
        Livewire::component('menu::create-edit-menu-item',CreateEditMenuItem::class);
        Livewire::component('menu::menu-builder',MenuBuilder::class);
        Livewire::component('menu::menu-table-component',MenuTableComponent::class);
    }

    private function setUpRoutes()
    {
        Route::mixin(new MenuRoutes);

        $this->app->bind('menuRoutes',function(){
            return new MenuRoutes;
        });
    }

    private function setUpViews()
    {
        $this->loadViewsFrom([
            resource_path($this->publishedViewPath),
            __DIR__.('/resources/views')
        ],'menu');
    }

    private function setUpConfig()
    {
        $this->mergeConfigFrom( __DIR__.$this->configPath, 'menu');
    }

    private function setUpMigrations()
    {
        $this->loadMigrationsFrom(
            __DIR__.'/database/migrations/'
        );
        
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
