<?php

namespace App\Http\Controllers\Api\Auth;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateUserRequest;

class UserProfileController extends Controller
{
    public function index()
    {
        try {
            $userDetail = new UserResource(Auth::user());
            return apiResponse(true, trans('messages.user_profile'), ['user' => $userDetail], 200);
        } catch (Exception $ex) {
            return apiResponse(false, $ex->getMessage(), [], 500);
        }
    }

    public function update(UpdateUserRequest $request)
    {
        try {
            if ($request->action == 'password') {
                Auth::user()->update(['password' => bcrypt($request->new_password)]);
            }
            if ($request->role == 'lender') {
            }
            Auth::user()->update($request->validated());

            $userDetail = new UserResource(Auth::user());


            return apiResponse(true, trans('messages.user_profile_updated'), ['user' => $userDetail], 200);
        } catch (Exception $ex) {
            return apiResponse(false, $ex->getMessage(), [], 500);
        }
    }
}
