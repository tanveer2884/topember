<?php

namespace App\Http\Controllers\Api\Auth;


use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\NewAccountRegistered;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\StoreUserRequest;
use App\Mail\NewVendorAccountRegistered;

class RegisterController extends Controller
{
    public function __invoke(StoreUserRequest $request)
    {
        try {
            $data = $request->validated();

            $data['password'] = bcrypt($request->password);

            $user = User::create($data);

            try {
                // Mail::send(
                //     $request->role == 'lender'
                //         ? new NewVendorAccountRegistered($user)
                //         : new NewAccountRegistered($user)
                // );
            } catch (Exception $e) {}

            return apiResponse(true, trans('messages.account_created'), [
                'token' => $user->createToken($request->email)->plainTextToken,
                'user' => new UserResource($user)
            ], 200);
        } catch (Exception $exception) {
            return apiResponse(false, $exception->getMessage(), [], 500);
        }
    }

    public function registerVendor(Request $request)
    {
        if (auth()->user()->is_lender) {
            abort(401, 'You are already a lender');
        }

        $data = $request->validate([
            'bio' => 'required|max:1000'
        ]);

        Auth::user()->update(
            array_merge($data, [
                'is_lender' => 1
            ])
        );

        // Mail::send(new NewVendorAccountRegistered(
        //     Auth::user()
        // ));

        return apiResponse(true, 'Vendor registered successfully');
    }
}
