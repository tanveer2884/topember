<?php

namespace App\Http\Controllers\Frontend\Auth;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class LoginController extends Controller
{
    public function __invoke()
    {
        return view('frontend.auth.login');
    }
}
