<?php

namespace App\Http\Controllers\Frontend\Account;

use Illuminate\Http\Request;
use Topdot\Order\Models\Order;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('frontend.account.orders.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Order $order)
    {
        if ( $order->user_id != Auth::id() ){
            throw new NotFoundHttpException();
        }

        return view('frontend.account.orders.show',compact('order'));
    }
}
