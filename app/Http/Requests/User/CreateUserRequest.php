<?php

namespace App\Http\Requests\User;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\URL;
use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array {
        $emailRule = isset($this->id)? ["required", "email", Rule::unique('users', 'email')->ignore($this->id)]: ["required", "email", "unique:users,email"];

        return [
            'name'      => 'required|string|max:255',
            'email'     => $emailRule,
            'password'  => URL::current() == route('users.store') ? 'required|string|min:6' : 'nullable',
        ];
    }

    public function messages() {
        return [
            'name.required'         => 'The name field is required.',
            'name.string'           => 'The name field must be a string.',
            'name.max'              => 'The name field must not exceed 255 characters.',
            'email.required'        => 'The email field is required.',
            'email.email'           => 'Please enter a valid email address.',
            'email.unique'          => 'The email address is already in use.',
            'password.required'     => 'The password field is required.',
            'password.string'       => 'The password field must be a string.',
            'password.min'          => 'The password must be at least 6 characters long.',
            'password.confirmed'    => 'The password confirmation does not match.',
            'image.required'        => 'The image field is required.',
        ];
    }

    // protected function failedValidation(Validator $validator) {
    //     throw new HttpResponseException($this->sendResponse(appStatic()::VALIDATION_ERROR, localize("There are errors in the form."), [], $validator->errors()));
    // }

    public function getUserData() {
        $data = $this->validated();

        if(URL::current() == route('users.store') || URL::current() == route('registration')) {
            $data['password']    = bcrypt($data['password']);
            $data['created_at']  = date("Y-m-d H:i:s");
        } else {
            $data['updated_at']  = date("Y-m-d H:i:s");
            unset($data['password']);
            unset($data['id']);
        }

        return $data;
    }
}
