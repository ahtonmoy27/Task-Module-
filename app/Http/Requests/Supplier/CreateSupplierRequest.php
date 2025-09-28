<?php

namespace App\Http\Requests\Supplier;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\URL;
use Illuminate\Foundation\Http\FormRequest;

class CreateSupplierRequest extends FormRequest{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array {
        return [
            'name'      =>  'required|string|max:255',
            'mobile_no' =>  'required|numeric',
            'email'     =>  'nullable|email|max:255',
            'address'   =>  'nullable|string|max:255',
            'is_active' =>  'required',
        ];
    }

    public function messages() {
        return [
            'name.required'         => 'The name field is required.',
            'name.string'           => 'The name field must be a string.',
            'name.max'              => 'The name field must not exceed 255 characters.',
            'mobile_no.required'    => 'The mobile number field is required.',
            'mobile_no.numeric'     => 'The mobile number field must be a number.',
            'mobile_no.max'         => 'The mobile number field must not exceed 255 characters.',
            'email.email'          => 'The email field must be a valid email address.',
            'email.max'            => 'The email field must not exceed 255 characters.',
            'address.string'       => 'The address field must be a string.',
            'address.max'          => 'The address field must not exceed 255 characters.',
            'is_active.required'   => 'The status field is required.',
        ];
    }

    public function getSupplierData(){
        $data = $this->validated();
        return $data ;
    }
}