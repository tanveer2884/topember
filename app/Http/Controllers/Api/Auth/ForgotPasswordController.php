<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotPasswordRequest;
use Exception;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function __invoke(ForgotPasswordRequest $request)
    {
        try {
            $response = Password::broker()->sendResetLink([
                'email' => $request->email,
                'is_active' => true,
            ]);

            throw_if(
                $response == Password::INVALID_USER,
                Exception::class,
                trans('messages.account_disabled')
            );

            throw_if(
                $response != Password::RESET_LINK_SENT,
                Exception::class,
                trans('messages.reset_link_sent_fail')
            );

            return apiResponse(true, trans('messages.email_sent'), [], 200);
        } catch (Exception $ex) {
            return apiResponse(false, $ex->getMessage(), [], 500);
        }
    }
}
