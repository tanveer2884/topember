<?php

namespace Topdot\Product\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Topdot\Product\Contracts\CreateProductRequest as ContractsCreateProductRequest;

class CreateProductRequest extends FormRequest implements ContractsCreateProductRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:191',
            // 'slug' => 'required|unique:products,slug,' . $this->product->id,
            'sku' => 'required|unique:products,sku',
            'model_number' => 'required',
            'qty' => 'required|numeric|gt:0',
            'weight' => 'required|numeric',
            'is_active' => 'nullable',
            'is_inStock' => 'nullable',
            'is_featured' => 'nullable',
            'is_recommended' => 'nullable',
            'short_description' => 'required|max:500',
            'description' => 'required',
            'price' => 'required|numeric|gt:0',

            'meta_title' => 'nullable|max:191',
            'meta_description' => 'nullable|max:250',

            'special_price' => 'sometimes|nullable|numeric|lte:price',
            'special_start_at' => 'nullable|date_format:Y-m-d',
            'special_end_at' => 'nullable|date_format:Y-m-d'.($this->special_start_at && $this->special_end_at ? '|after:special_start_at':'')
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            'special_price.lte' => 'Sale price must be less than or equal to Actual Price.'
        ];
    }
}
