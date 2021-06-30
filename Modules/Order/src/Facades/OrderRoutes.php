<?php 

namespace Topdot\Order\Facades;

use Illuminate\Support\Facades\Facade;

class OrderRoutes extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'orderRoutes';
    }

    public static function register($options = [])
    {
        app()->make('router')->orderRoutes($options);
    }
}