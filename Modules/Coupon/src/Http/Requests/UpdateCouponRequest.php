<?php

namespace Topdot\Coupon\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCouponRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name" => 'required|max:191',
            "code" => 'required|max:191|unique:coupons,code,'.$this->coupon->id,
            "value" => 'required|numeric'.( $this->has('discount_is_percent') ? '|lte:99.99':'' ),
            "discount_is_percent" => 'nullable',
            "is_free_shipping" => 'nullable',
            "start_at" => 'required|date_format:Y-m-d',
            "end_at" => 'required|date_format:Y-m-d|after:start_at',
            "is_active" => 'nullable',
            "is_site_wide" => 'nullable',

            "products" => 'nullable|array',
            "products.*" => 'nullable|exists:products,id',

            "excludeProducts" => 'nullable|array',
            "excludeProducts.*" => 'nullable|exists:products,id',

            "categories" => 'nullable|array',
            "categories.*" => 'nullable|exists:categories,id',

            "excludeCategories" => 'nullable|array',
            "excludeCategories.*" => 'nullable|exists:categories,id',

            "users" => 'nullable|array',
            "users.*" => 'nullable|exists:users,id',
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
}
