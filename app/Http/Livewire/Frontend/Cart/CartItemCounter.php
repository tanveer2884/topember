<?php

namespace App\Http\Livewire\Frontend\Cart;

use Darryldecode\Cart\Facades\CartFacade;
use Livewire\Component;

class CartItemCounter extends Component
{
    public $qty;

    protected $listeners = [
        'cart-updated' => 'reQtyCalculated',
        'update-counter' => 'reQtyCalculated'
    ];

    public function mount()
    {
        $this->qty = 0;

        $this->reQtyCalculated();
    }

    public function render()
    {
        return view('livewire.frontend.cart.cart-item-counter');
    }

    public function reQtyCalculated()
    {
        $this->qty = 0;
        CartFacade::getContent()->each(function($item){
            $this->qty += $item->quantity;
        });
    }
}
