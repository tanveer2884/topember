<?php

namespace App\Http\Livewire\Frontend\Cart;

use Darryldecode\Cart\Facades\CartFacade;
use Livewire\Component;

class DeliveryOption extends Component
{
    public $isAtHome;
    public $isAtStore;

    public function mount()
    {

        $this->isAtHome = CartFacade::getValue('is_delivery_at_home',false);
        $this->isAtStore = CartFacade::getValue('is_delivery_at_store',false);
    }

    public function render()
    {
        return view('livewire.frontend.cart.delivery-option');
    }

    public function updatedIsAtHome()
    {
        CartFacade::setValue('is_delivery_at_home',$this->isAtHome);
    }

    public function updatedIsAtStore()
    {
        CartFacade::setValue('is_delivery_at_store',$this->isAtStore);
    }
}
