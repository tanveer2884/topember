<?php

namespace Topdot\Category;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class CategoryServiceProvider extends ServiceProvider
{
    public $routeFilePath = '/routes';
    public $publishedViewPath = '/views/admin/category';
    public $configPath = '/config/category.php';

    public function boot()
    {
        $this->setUpConfig();
        $this->setUpViews();
        $this->setUpRoutes();

        if ($this->app->runningInConsole()) {
            $this->publishAssets();
        }

    }

    private function setUpRoutes()
    {
        Route::mixin(new CategoryRoutes);

        $this->app->bind('categoryRoutes',function(){
            return new CategoryRoutes;
        });
    }

    private function setUpViews()
    {
        $this->loadViewsFrom([
            resource_path($this->publishedViewPath),
            __DIR__ . ('/resources/views')
        ], 'category');
    }

    private function setUpConfig()
    {
        $this->mergeConfigFrom(__DIR__ . $this->configPath, 'category');
    }

    private function publishAssets()
    {
       
        $this->publishes([
            __DIR__ . '/resources/views' => resource_path($this->publishedViewPath),
        ], 'views');

        $this->publishes([
            __DIR__ . $this->routeFilePath => base_path($this->routeFilePath),
        ], 'routes');

        $this->publishes([
            __DIR__ . $this->configPath => base_path($this->configPath),
        ], 'config');

        if (! class_exists('CreateCategoriesTable')) {
            $this->publishes([
                __DIR__ . '/database/migrations/2021_01_14_094535_create_categories_table.php' => database_path('migrations/2021_01_14_094535_create_categories_table.php'),
            ], 'migrations');
        }
    }
}
