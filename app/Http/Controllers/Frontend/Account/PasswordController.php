<?php

namespace App\Http\Controllers\Frontend\Account;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PasswordController extends Controller
{
    public function __invoke()
    {
        return view('frontend.account.profile.password');
    }
}
