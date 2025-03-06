<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'status' => 'required|boolean',
            'attributes_values' => 'array',
            'attributes_values.*.attribute_id' => 'required|exists:attributes,id',
            'attributes_values.*.value' => 'required',
            'users' => 'nullable|array',
            'users.*' => 'exists:users,id',
        ];
    }
}
