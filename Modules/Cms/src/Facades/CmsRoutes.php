<?php 

namespace Topdot\Cms\Facades;

use Illuminate\Support\Facades\Facade;

class CmsRoutes extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'cmsRoutes';
    }

    public static function register($options = [])
    {
        app()->make('router')->cmsRoutes($options);
    }
}