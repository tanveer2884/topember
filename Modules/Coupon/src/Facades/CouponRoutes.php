<?php 

namespace Topdot\Coupon\Facades;

use Illuminate\Support\Facades\Facade;

class CouponRoutes extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'couponRoutes';
    }

    public static function register($options = [])
    {
        app()->make('router')->couponRoutes($options);
    }
}