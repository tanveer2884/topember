<?php 

namespace Topdot\Core\Facades;

use Illuminate\Support\Facades\Facade;

class CoreRoutes extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'coreRoutes';
    }

    public static function register($options = [])
    {
        app()->make('router')->registerRoutes($options);
    }

    public static function registerPublic($options = [])
    {
        app()->make('router')->registerPublicRoutes($options);
    }
}