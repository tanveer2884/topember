<?php

namespace App\Http\Requests\Testimonials;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTestimonial extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required',
            // 'image' => 'nullable|image|max:2048',
            'description' => 'required|max:500',
            // 'rating' => 'required|min:1|max:5',
        ];
    }
}
