<?php

namespace App\Http\Livewire\Frontend\Cart;

use Livewire\Component;
use Topdot\Product\Models\Product;
use Darryldecode\Cart\Facades\CartFacade;

class AddToCartButton extends Component
{
    public $product;
    public $qty;
    public $showQty;

    public function mount(Product $product, $showQty = true)
    {
        $this->product = $product;
        $this->qty = 1;
        $this->showQty = $showQty;
    }

    public function render()
    {
        return view('livewire.frontend.cart.add-to-cart-button');
    }

    public function addToCart()
    {
        if ( $this->qty <=0 ){
            $this->emit('alert-danger', 'Invalid Qty');
            return;
        }
        
        if ( !$this->product->isInStock()  || $this->product->qty <=0 || ( ($item = CartFacade::get($this->product->id)) && ( $item->quantity + $this->qty ) > $this->product->qty ) ){
            $this->emit('alert-danger', 'Quantity limit exceeded');
            return;
        }
        

        CartFacade::add(
            $this->product->id,
            $this->product->name,
            $this->product->getPrice(),
            $this->qty,
            [],
            [],
            $this->product
        );

        $this->qty = 1;
        $this->emit('cart-updated');
        $this->emit('alert-success','Product Added to cart');
    }
}
