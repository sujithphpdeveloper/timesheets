<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateProjectTimesheetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized and valid project
     */
    public function authorize(): bool
    {
        // Get the project ID from the route
        $project = $this->route('project');

        return $project->users()->where('user_id', Auth::id())->exists();
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
        ];
    }
}
