<?php

namespace App\Http\Requests;

use App\Rules\PasswordValidator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $this->phone = preg_replace("/[^0-9]/", "", $this->phone);

        $rules = [
            'first_name' => 'required|max:30',
            'last_name' => 'required|max:30',
            'email' => 'required|email:filter,rfc,dns|unique:users,email',
            'phone' => 'required|min:11|regex:/^1(?!0{10})[0-9]{10}$/|max:15',
            'password' => [
                'required',
                'min:8',
                new PasswordValidator()
            ],
            'confirmPassword' => 'required|same:password',
        ];

        // if (auth()->check() && auth()->user()->is_lender != 1) {

        //     $rules = [];

        //     // $rules['first_name'] = 'nullable';
        //     // $rules['last_name'] = 'nullable';
        //     // $rules['email'] = 'nullable';
        //     // $rules['phone'] = 'nullable';
        //     // $rules['password'] = 'nullable';
        //     // $rules['confirmPassword'] = 'nullable';
        // }

        return $rules;
    }
}
