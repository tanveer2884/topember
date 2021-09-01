<?php

namespace App\Http\Livewire\Frontend\Cart;

use Livewire\Component;
use Topdot\Product\Models\Product;
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
        return view('livewire.frontend.cart.cart-item');
    }

    public function increaseQty()
    {
        $id = $this->cartProduct->id;
        if (!optional(Product::find($id))->isInStock() || CartFacade::get($id)->quantity >= optional(Product::find($id))->qty ){
            $this->emit('alert-danger','Quantity limit exceeded');
            return;
        }

        CartFacade::update($id,[
            'quantity' => '+1'
        ]);

        $this->emit('alert-success','Quantity Updated');
        $this->emit('cart-updated');
        $this->emit('update-order-summary');
    }

    public function decreaseQty()
    {
        $id = $this->cartProduct->id;
        if ( CartFacade::get($id)->quantity <=1 ){
            $this->emit('alert-danger','Quantity cannot be zero.');
            return;
        }

        CartFacade::update($id,[
            'quantity' => '-1'
        ]);

        $this->emit('alert-success','Quantity Updated.');
        $this->emit('cart-updated');
        $this->emit('update-order-summary');
    }

    public function updateQty($quantity=0) {

        if ( $quantity < 1 ){
            $this->emit('alert-danger','Quantity cannot be zero.');
            return;
        }


        CartFacade::update($this->cartProduct->id,[
            'quantity' => [
                'value' => $quantity,
                'relative' => false
            ]
        ]);

        $this->emit('alert-success','Quantity Updated.');
        $this->emit('cart-updated');
        $this->emit('update-order-summary');
    }

    public function hydrate()
    {
        $this->cartProduct = CartFacade::get($this->cartProduct->get('id'));
    }
}
