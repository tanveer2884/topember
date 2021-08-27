<?php

namespace App\Http\Livewire\Frontend\Cart;

use Livewire\Component;
use Topdot\Core\Traits\WithUniqueId;
use Darryldecode\Cart\CartCollection;
use Darryldecode\Cart\Facades\CartFacade;

class CartItemsList extends Component
{
    use WithUniqueId;

    public $listeners = [
        'item-removed' => 'render',
        'delete-item' => 'removeItem'
    ];

    public function render()
    {
        if ( CartFacade::isEmpty() ){
            $this->emit('reload-page');
        }
        
        return view('livewire.frontend.cart.cart-items-list',[
            'cartItems' => cart()->getContent()
        ]);
    }

    public function removeItem($item)
    {
        CartFacade::remove($item);
        $this->emit('alert-success','Item removed from cart');
        $this->emit('update-order-summary');
    }
}
