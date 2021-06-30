<?php 

namespace Topdot\Product\Facades;

use Illuminate\Support\Facades\Facade;

class ProductRoutes extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'productRoutes';
    }

    public static function register($options = [])
    {
        app()->make('router')->routes($options);
    }
}