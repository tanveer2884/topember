<?php

namespace App\Http\Livewire\Frontend\Cart;

use Livewire\Component;
use Darryldecode\Cart\Facades\CartFacade;
use Topdot\Coupon\Services\CouponCalculator;

class OrderSummary extends Component
{
    public $subTotal;
    public $tax;
    public $shipping;
    public $discount;
    public $total;
    public $isCouponApplied;
    public $sidebar;

    public $listeners = [
        'update-order-summary' => 'render'
    ];

    public function mount($sidebar=true)
    {
        $this->sidebar = $sidebar;
        $this->setVariables();
    }

    public function render()
    {
        return view('livewire.frontend.cart.order-summary');
    }

    public function hydrate()
    {
        $this->setVariables();
    }

    public function setVariables()
    {
        $this->subTotal = CartFacade::getSubTotalWithoutConditions();
        $this->tax = 0;
        $this->shipping = 0;
        $this->discount = CouponCalculator::isCouponApplied() ? CartFacade::getSubTotalWithoutConditions() - CartFacade::getSubTotal() : 0;
        $this->total = CartFacade::getTotal();
        $this->isCouponApplied = CouponCalculator::isCouponApplied();
    }
}
