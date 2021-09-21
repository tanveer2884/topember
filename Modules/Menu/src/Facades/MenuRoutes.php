<?php

namespace Topdot\Menu\Facades;

use Illuminate\Support\Facades\Facade;

class MenuRoutes extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'menuRoutes';
    }

    public static function register($options = [])
    {
        app()->make('router')->menuRoutes($options);
    }
}
