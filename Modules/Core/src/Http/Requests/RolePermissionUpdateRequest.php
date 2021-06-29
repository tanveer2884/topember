<?php

namespace Topdot\Core\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Role\Models\Role;

class RolePermissionUpdateRequest extends FormRequest
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
        if (!$this->has('permissions')) {
            return [];
        }

        return [
            'permissions' => 'array|min:1',
            'permissions.*' => 'integer|exists:permissions,id'
        ];
    }
}
