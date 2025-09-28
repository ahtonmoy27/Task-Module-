<?php

namespace App\Http\Requests\Product;

use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\URL;
use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_category_id'      => ['required', 'exists:product_categories,id'],
            'product_sub_category_id'  => ['required', 'exists:product_sub_categories,id'],
            'name'                     => ['required', 'string', 'max:255'],
            'description'              => ['nullable', 'string'],
            'image'                    => ['required', 'image', 'mimes:jpg,jpeg,png,webp,gif', 'max:2048'],
            'old_price'                => ['nullable', 'numeric', 'min:0'],
            'new_price'                => ['required', 'numeric', 'min:0'],
            'is_active'                => ['required', 'boolean'],
        ];
    }

    public function messages()
    {
        return [
            // Name
            'name.required'         => 'The name field is required.',
            'name.string'           => 'The name field must be a string.',
            'name.max'              => 'The name field must not exceed 255 characters.',

            // Product Category
            'product_category_id.required'     => 'The product category field is required.',

            // Product Sub Category
            'product_sub_category_id.required' => 'The product sub category field is required.',

            // Description
            'description.string'               => 'The description must be a valid text.',

            // Image
            'image.image'     => 'The file must be an image.',
            'image.mimes'     => 'The image must be a file of type: jpg, jpeg, png, webp, gif.',
            'image.max'       => 'The image size must not exceed 2MB.',

            // Old Price
            'old_price.numeric' => 'The old price must be a number.',
            'old_price.min'     => 'The old price must be at least 0.',

            // New Price
            'new_price.required' => 'The new price field is required.',
            'new_price.numeric'  => 'The new price must be a number.',
            'new_price.min'      => 'The new price must be at least 0.',

            // Status
            'is_active.required' => 'The status field is required.',
            'is_active.boolean'  => 'The status field must be true or false.',
        ];
    }

    public function getProductData()
    {
        $data = $this->validated();
        $data['slug'] = Str::slug($data['name']);
        return $data;
    }
}
