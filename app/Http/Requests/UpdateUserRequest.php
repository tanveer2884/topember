<?php

namespace App\Http\Requests;

use App\Rules\PasswordValidator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'username' => 'required|max:30|unique:users,username,' . Auth::id(),
            'first_name' => 'required|max:30',
            'last_name' => 'required|max:30',
            'phone' => 'required|min:11|regex:/^1(?!0{10})[0-9]{10}$/',
        ];

        if ($this->wantsJson() && $this->role == 'lender') {
            $rules['bio'] = 'required';
            $rules['username'] = 'nullable';
            $rules['phone'] = 'nullable';
        }

        if ($this->wantsJson() && $this->photo && $this->role == 'lender') {
            $rules['photo'] = 'mimes:jpg,jpeg,png|max:10240';
        }

        if ($this->wantsJson() && $this->banner && $this->role == 'lender') {
            $rules['banner'] = 'mimes:jpg,jpeg,png|max:10240';
        }

        if ($this->wantsJson() && $this->action == 'password') {
            $rules['username'] = 'nullable';
            $rules['first_name'] = 'nullable';
            $rules['last_name'] = 'nullable';
            $rules['phone'] = 'nullable';
            $rules['old_password'] = [
                'bail',
                'required',
                function ($attribute, $value, $fail) {
                    if (!Hash::check($value, Auth::user()->password)) {
                        $fail('The given old password is invalid.');
                    }
                }
            ];
            $rules['new_password'] = [
                'bail',
                'required',
                'min:8',
                new PasswordValidator(
                    Auth::user(),
                    true
                )
            ];
            $rules['confirm_password'] = 'required|min:8|same:new_password';
        }


        return $rules;
    }
}
