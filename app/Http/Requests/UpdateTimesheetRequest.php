<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTimesheetRequest extends FormRequest
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
            'task_name' => 'sometimes|string|max:255',
            'date' => 'sometimes|date',
            'hours' => 'sometimes|integer|min:1|max:24',
            'user_id' => 'sometimes|exists:users,id',
            'project_id' => 'sometimes|exists:projects,id',
        ];
    }
}
