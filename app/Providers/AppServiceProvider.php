<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        $this->registerProductsRoutesSelector();
    }


    public function registerProductsRoutesSelector()
    {
        Route::pattern('categoryOrProductSlug','.*');
        Route::bind('categoryOrProductSlug',function($subCategories, $route){
            
            $route->forgetParameter('categoryOrProductSlug');
            $route->setParameter('categories',[]);
            $route->setParameter('product', null);
           

            $slugsArray = explode('/',$subCategories);
            $lastSlug = $slugsArray[count($slugsArray)-1];
            $secondLastSlug = optional($slugsArray)[count($slugsArray)-2];

            if ( $product = isProduct($lastSlug, $secondLastSlug)){
                $route->setParameter('categories',array_slice($slugsArray,0,count($slugsArray)-1));
                $route->setParameter('product', $product);
                return;
            }

            if ( isCategory($lastSlug)){
                $route->setParameter('categories',$slugsArray);
            }

            return null;
        });
    }
}
