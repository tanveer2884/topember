<?php

namespace App\Http\Controllers\Frontend\Cart;

use Darryldecode\Cart\Facades\CartFacade;

class CheckoutController
{
    public function __invoke()
    {
        if (!CartFacade::isEmpty()) {
            return view('frontend.cart.checkout');
        }

        return redirect()->route('cart');
    }
}
