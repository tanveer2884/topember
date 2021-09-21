<?php

namespace Topdot\Category\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryUpdateRequest extends FormRequest
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
            'name' => 'required|max:191|unique:categories,name,'.$this->category->id,
            'status' => 'required|in:1,0',
            'image' => 'nullable|array'
        ];
    }
}
