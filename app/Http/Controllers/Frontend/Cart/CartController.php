<?php

namespace App\Http\Controllers\Frontend\Cart;

use Darryldecode\Cart\Facades\CartFacade;

class CartController
{
    public function __invoke()
    {
        if (!CartFacade::isEmpty()) {
            return view('frontend.cart.index');
        }

        return view('frontend.cart.empty-cart');
    }
}
