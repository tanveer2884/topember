<?php

namespace App\Http\Livewire\Frontend\Cart;

use Livewire\Component;
use Topdot\Coupon\Services\CouponCalculator;

class CouponCode extends Component
{
    public $coupon;
    public $couponApplied;
    protected $listeners = [
        'cart-updated' => 'refreshCoupon'
    ];

    public function mount()
    {
        $this->coupon = CouponCalculator::isCouponApplied() ? CouponCalculator::getAppliedCopon() : '';
        $this->couponApplied = CouponCalculator::isCouponApplied() ? true : false;
    }

    public function render()
    {
        return view('livewire.frontend.cart.coupon-code');
    }

    public function refreshCoupon()
    {
        if ( !$this->coupon || !$this->couponApplied ){
            return;
        }

        if ( !CouponCalculator::refreshCoupon($this->coupon) ){
            $this->coupon = null;
            $this->couponApplied = false;
        }
    }
    
    public function applyCoupon()
    {
        $this->resetErrorBag();

        if ( !CouponCalculator::applyCoupon($this->coupon) ){
            $error = CouponCalculator::getError();
            $this->addError('coupon',$error);
            $this->emit('alert-danger',$error);
            return;
        }

        $this->couponApplied = true;

        $this->emit('update-order-summary');
        $this->emit('alert-success', 'Coupon Applied');
    }

    public function removeCoupon()
    {
        $this->coupon = '';
        $this->resetErrorBag();

        if ( $this->couponApplied ){
            CouponCalculator::removeCoupon();
            $this->couponApplied = false;
            $this->emit('update-order-summary');
        }

        // $this->emit('update-order-summary');
        $this->emit('alert-succes', 'Coupon removed');
    }
}
