<?php

namespace App\Http\Controllers\Frontend\Cart;

use App\Http\Controllers\Controller;
use Darryldecode\Cart\Facades\CartFacade;

class OrderConfirmationController extends Controller
{
    public function index()
    {
        if (!CartFacade::isEmpty()) {
            return view('frontend.cart.confirm-order');
        }

        return redirect()->route('cart');
    }
}
