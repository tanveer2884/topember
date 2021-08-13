<?php

namespace Topdot\Coupon\Services;

use Topdot\Coupon\Models\Coupon;
use Darryldecode\Cart\CartCondition;
use Illuminate\Support\Facades\Auth;
use Darryldecode\Cart\Facades\CartFacade;

class CouponCalculator
{
    public static $error;

    public static function refreshCoupon($coupon)
    {
        self::removeCoupon();
        return self::applyCoupon($coupon);
    }

    public static function applyCoupon($coupon)
    {
        $coupon = Coupon::query()->active()->where('code',$coupon)->first();
        
        if ( !$coupon || $coupon->isExpiredOrNotAvailable()){
            self::$error = 'Invalid Coupon Code';
            return false;
        }

        if ( $coupon->isSiteWide() ){
            
            if ( !$coupon->isDiscountPercent() &&  $coupon->value >= CartFacade::getSubTotalWithoutConditions() ){
                self::$error = 'Coupon is not applicable';
                return false;
            }

            CartFacade::condition(self::getCartCondition($coupon));
            return true;
        }

        /**
         * Check if users are sepecified for coupon by admin and this user is not eligible
         */
        if ( $coupon->users()->count() >0 && !self::isApplicableToUser($coupon) ){
            self::$error = 'Coupon is not applicable to this user';
            return false;
        }

        /**
         * Check if users are sepecified for coupon by admin but no product specified 
         * if user is eligible for coupon
         * then apply coupon to cart level
         */
        if ( $coupon->users()->count() >0 && self::isApplicableToUser($coupon) &&  $coupon->includedProducts()->count() <= 0 ){
            CartFacade::condition(self::getCartCondition($coupon));
            return true;
        }

        /**
         * if products are specified check excluded and included products
         * and apply coupon
         */
        if ( $coupon->includedProducts()->count() >0 ){
            return self::applyCoponToOnlyApplicableProducts($coupon);
        }

        /**
         * if no condition met return coupon invalid error
         */
        self::$error = 'Coupon is not applicable';
        return false;
    }

    public static function removeCoupon()
    {
        CartFacade::clearCartConditions();
        foreach (CartFacade::getContent() as $item) {
            CartFacade::clearItemConditions($item->id);
        }

        return true;
    }

    private static function applyCoponToOnlyApplicableProducts(Coupon $coupon)
    {
        $cartItems = CartFacade::getContent();
        $notApplicableProducts = $coupon->excludedProducts->pluck('id')->toArray();
        $applicableProducts = $coupon->includedProducts->pluck('id')->toArray();

        foreach ($cartItems as $item) {

            if ( !in_array($item->id,$applicableProducts) ){
                continue;
            }

            if ( in_array($item->id, $notApplicableProducts) ){
                continue;
            }

            if ( !$coupon->isDiscountPercent() && $coupon->value >= $item->price ){
                continue;
            }

            CartFacade::addItemCondition($item->id, self::getCouponCondition($coupon));
        }

        if ( self::getItemConditions('coupon')->count() <= 0 ){
            self::$error = 'Coupon is not applicable to selected products';
            return false;
        }

        return true;
    }

    private static function isApplicableToUser(Coupon $coupon)
    {
        $applicableUsers = $coupon->users->pluck('id')->toArray();

        if ( !Auth::check() || !in_array(Auth::id(),$applicableUsers ) ){
            self::$error = 'This coupon is not valid for this user';
            return false;
        }

        return true;
        
    }

    private static function getCouponCondition(Coupon $coupon)
    {
        return new CartCondition([
            'name' => $coupon->code,
            'type' => 'coupon',
            'value' => $coupon->isDiscountPercent() ? "-{$coupon->value}%" : "-{$coupon->value}",
        ]);
    }

    private static function getCartCondition(Coupon $coupon)
    {
        return new CartCondition([
            'name' => $coupon->code,
            'type' => 'coupon',
            'value' => $coupon->isDiscountPercent() ? "-{$coupon->value}%" : "-{$coupon->value}",
            'target' => 'subtotal'
        ]);
    }

    public static function isCouponApplied()
    {
        return CartFacade::getConditionsByType('coupon')->count() || self::getItemConditions('coupon')->count();
    }

    public static function getAppliedCopon()
    {
        if ( !self::isCouponApplied() ){
            return null;
        }

        if ( $cartCondition = CartFacade::getConditionsByType('coupon')->first() ){
            return $cartCondition->getName();
        }

        if ( $itemCondition = self::getItemConditions('coupon')->first() ){
            return $itemCondition->getName();
        }

        return null;
    }

    public static function getItemConditions($type)
    {
        $hasItemCondition = collect();

        foreach (CartFacade::getContent() as $item) {
            if ( !$item->hasConditions() ){
                continue;
            }

            $hasItemCondition = collect($item->getConditions())->filter(function (CartCondition $condition) use ($type) {
                return $condition->getType() == $type;
            });
        }

        return $hasItemCondition;
    }

    public static function getError()
    {
        $error = self::$error;
        self::$error = null;
        return $error;
    }
}