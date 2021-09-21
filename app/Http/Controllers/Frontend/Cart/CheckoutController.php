<?php

namespace App\Http\Controllers\Frontend\Cart;

use App\Http\Controllers\Controller;
use Darryldecode\Cart\Facades\CartFacade;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        if (!CartFacade::isEmpty()) {
            return view('frontend.cart.checkout');
        }

        return redirect()->route('cart');
    }

    public function store(Request $request)
    {

    }
}
