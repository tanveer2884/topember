<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use Exception;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $request)
    {
        try {
            if (
                ! Auth::attempt([
                    'email' => $request->email,
                    'password' => $request->password,
                ])
            ) {
                return apiResponse(false, trans('messages.invalid_credentials'), [], 500);
            }

            /** @var $user App/Models/User */
            $user = Auth::user();

            if (! $user->isActive()) {
                Auth::logout();

                return apiResponse(false, trans('messages.account_disabled'), [], 500);
            }

            return apiResponse(true, trans('messages.logged_in'), [
                'token' => $user->createToken($request->email)->plainTextToken,
                'user' => new UserResource($user),
            ], 200);
        } catch (Exception $exception) {
            return apiResponse(false, $exception->getMessage(), [], 500);
        }
    }
}
