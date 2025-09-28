<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tasks' => 'required|array|min:1',
            'tasks.*.title' => 'required|string|max:255',
            'tasks.*.description' => 'nullable|string'
        ];
    }

    public function messages(): array
    {
        return [
            'tasks.required' => 'At least one task is required',
            'tasks.*.title.required' => 'Each task must have a title',
        ];
    }
}