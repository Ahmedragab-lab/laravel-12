<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'category_id' => 'required',
            'brand_id' => 'required',
            'product_name' => 'required',
            'expiration_date' => 'nullable',
            'discount' => 'nullable',
            'price' => 'nullable',
            'stock' => 'nullable',
            'image' => 'nullable',
            'description' => 'nullable',

            // 'status' => 'nullable',
            // 'color_id' => 'nullable|array',
            // 'color_id.*' => 'exists:colors,id',
            // 'size_id' => 'nullable|array',
            // 'size_id.*' => 'exists:sizes,id',
        ];
    }
}
