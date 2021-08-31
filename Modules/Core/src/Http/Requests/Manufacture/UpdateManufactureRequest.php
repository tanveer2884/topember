<?php

namespace Topdot\Core\Http\Requests\Manufacture;

use Illuminate\Foundation\Http\FormRequest;

class UpdateManufactureRequest extends FormRequest
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
        return [
            'name' => 'required|max:191|unique:manufacturers,name,'.$this->manufacture->id,
            'image' => 'nullable|array|min:1'
        ];
    }
}
