<?php

namespace App\Http\Controllers\Frontend\Auth;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PasswordResetController extends Controller
{
    public function __invoke($token)
    {
        $passwordResetRequests = DB::table('password_resets')->where('email',request('email'))->first();

        if ( !$passwordResetRequests || !Hash::check($token,$passwordResetRequests->token)){
            session()->flash('alert-warning','Token Expired');
            abort(410);
        }
        return view('frontend.auth.reset-password',compact('token'));
    }
}
