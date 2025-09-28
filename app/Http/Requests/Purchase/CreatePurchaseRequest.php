<?php

namespace App\Http\Requests\Purchase;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\URL;
use Illuminate\Foundation\Http\FormRequest;

class CreatePurchaseRequest extends FormRequest{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array {
        return [
            'product_id'      => 'required|exists:products,id',
            'is_active'       => ['nullable', 'boolean'],
            'quantity'        => 'required|integer|min:1',
            'price'           => 'required|numeric|min:0',
            'purchase_date'   => 'required|date',
            'supplier_id'     => 'required|exists:suppliers,id',
            'description'     => 'nullable|string|max:500',
        ];
    }

    public function messages() {
        return [
            'product_id.required'    => 'The product field is required.',
            'product_id.exists'      => 'The selected product is invalid.',
            'supplier_id.required'   => 'The supplier field is required.',
            'supplier_id.exists'     => 'The selected supplier is invalid.',
            'quantity.required'      => 'The quantity field is required.',
            'quantity.integer'       => 'The quantity must be an integer.',
            'quantity.min'           => 'The quantity must be at least 1.',
            'price.required'         => 'The price field is required.',
            'price.numeric'          => 'The price must be a number.',
            'price.min'              => 'The price must be at least 0.',
            'purchase_date.required' => 'The purchase date field is required.',
            'purchase_date.date'     => 'The purchase date is not a valid date.',
            'description.string'     => 'The description must be a string.',
            'description.max'        => 'The description may not be greater than 500 characters.',
        ];
    }

    public function getPurchaseData(){
        $data = $this->validated();
        return $data ;
    }
}