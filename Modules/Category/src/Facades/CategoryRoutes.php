<?php 

namespace Topdot\Category\Facades;

use Illuminate\Support\Facades\Facade;

class CategoryRoutes extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'categoryRoutes';
    }

    public static function register($options = [])
    {
        app()->make('router')->categoryRoutes($options);
    }
}