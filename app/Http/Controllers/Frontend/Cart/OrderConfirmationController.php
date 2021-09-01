<?php

namespace App\Http\Controllers\Frontend\Cart;

use App\Http\Controllers\Controller;
use App\Mail\OrderCreated;
use App\Services\OrderService;
use Darryldecode\Cart\Facades\CartFacade;
use Darryldecode\Cart\ItemCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Topdot\Coupon\Models\Coupon;
use Topdot\Coupon\Services\CouponCalculator;
use Topdot\Order\Models\Order;
use Topdot\Product\Models\Product;

class OrderConfirmationController extends Controller
{
    public function index()
    {
        if (CartFacade::isEmpty()) {
            return redirect()->route('cart');
        }

        $data = [
            'products' => CartFacade::getContent(),
            'payment' => CartFacade::getValue('payment', []),
            'shipping' => CartFacade::getValue('shipping', []),
            'billing' => CartFacade::getValue('billing', []),
            'is_shipping_billing_same' => CartFacade::getValue('is_shipping_billing_same', true),
        ];

        return view('frontend.cart.confirm-order', $data);
    }

    public function store(Request $request, OrderService $orderService)
    {
        $order = $orderService->from($request)
            ->create();

        if ( ! $order ){
            session()->flash('alert-danger',$orderService->getError());
            return back();
        }

        Mail::send(new OrderCreated($order));
        Mail::send(new OrderCreated($order, true));

        return redirect()->route('thank-you', ['order_number' => $order->order_id]);
    }
}
