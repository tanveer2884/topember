<?php

namespace App\Http\Livewire\Frontend\Cart;

use Livewire\Component;
use Darryldecode\Cart\ItemCollection;
use Darryldecode\Cart\Facades\CartFacade;

class CartItem extends Component
{
    public $cartProduct;

    public function mount($cartProduct)
    {
        $this->cartProduct = $cartProduct; 
    }

    public function render()
    {
        $this->cartProduct = CartFacade::get($this->cartProduct->get('id'));
        return view('livewire.frontend.cart.cart-item');
    }
}
