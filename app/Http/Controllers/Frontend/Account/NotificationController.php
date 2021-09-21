<?php

namespace App\Http\Controllers\Frontend\Account;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class NotificationController extends Controller
{
    public function __invoke()
    {
        return view('frontend.account.notifications.index');
    }
}
