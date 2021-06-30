<?php

namespace Topdot\Order\Http\Controllers;

use Topdot\Order\Models\Order;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('order::index');
    }


    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Order $order)
    {
        return view('order::show',compact('order'));
    }
}
