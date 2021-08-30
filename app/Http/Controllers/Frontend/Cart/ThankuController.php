<?php

namespace App\Http\Controllers\Frontend\Cart;

use Illuminate\Http\Request;

class ThankuController
{
    public function __invoke(Request $request)
    {
        $orderId = $request->order_number;
        return view('frontend.cart.thank-you',compact('orderId'));
    }
}
