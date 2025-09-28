<?php

namespace App\Http\Requests\ProductCategory;

use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\URL;
use Illuminate\Foundation\Http\FormRequest;

class CreateProductCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('product_categories', 'name')->ignore($this->id),
            ],
            'is_active' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'name.required'     => 'The name field is required.',
            'name.unique'       => 'The name has already been taken.',
            'name.max'          => 'The name may not be greater than 255 characters.',
            'is_active.required' => 'The status field is required.',
        ];
    }

    public function getData()
    {
        $data = $this->validated();
        $data['slug'] = Str::slug($data['name']);
        return $data;
    }
}
