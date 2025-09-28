<?php

namespace App\Http\Requests\Order;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\URL;
use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array {
        return [
            'order_no'      => ['required', 'string', 'max:255'],
            'product_id'    => ['required', 'exists:products,id'],
            'order_date'    => ['required', 'date'],
            'total_amount'  => ['required', 'numeric', 'min:0'],
            'paid'          => ['required', 'numeric', 'min:0'],
            'supplier_id'   => ['required', 'exists:suppliers,id'],
            'description'   => ['nullable', 'string'],
            'is_delivered'  => ['required', 'boolean'],
        ];
    }

    public function messages() {
        return [
            'order_no.required'     => 'Order No is required',
            'order_no.unique'       => 'Order No must be unique',
            'product_id.required'   => 'Product is required',
            'product_id.exists'     => 'Selected Product is invalid',
            'total_amount.required' => 'Total Amount is required',
            'total_amount.numeric'  => 'Total Amount must be a number',
            'total_amount.min'      => 'Total Amount must be at least 0',
            'paid.required'         => 'Paid Amount is required',
            'paid.numeric'          => 'Paid Amount must be a number',
            'paid.min'              => 'Paid Amount must be at least 0',
            'order_date.required'   => 'Order Date is required',
            'order_date.date'       => 'Order Date must be a valid date',
            'supplier_id.required'  => 'Supplier is required',
            'supplier_id.exists'    => 'Selected Supplier is invalid',
            'description.string'    => 'Description must be a string',
            'is_delivered.required' => 'Status is required',
            'is_delivered.boolean'  => 'Status must be true or false',
        ];
    }

    public function getOrderData(){
        $data = $this->validated();
        return $data ;
    }
}