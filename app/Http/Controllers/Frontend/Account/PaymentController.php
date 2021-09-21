<?php

namespace App\Http\Controllers\Frontend\Account;

use App\Utils\Elavon\Payment;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('frontend.account.payments.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('frontend.account.payments.create');
    }

    public function payment() {
        $payment = new Payment();
        $pay = $payment->pay();
        dd($pay);
    }

}
