<?php

namespace Topdot\Core\Http\Requests;

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
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => 'required|max:191',
            'email' => 'required|email|unique:users,email,'.$this->user->id,
            'password' => $this->password ? 'required|confirmed|min:8':''
        ];

        return $rules;
    }
}
