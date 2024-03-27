<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // check if super admin
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
            'title' => [
                'required',
                'string',
                'max:250',
                // Rule::unique(table: 'tasks', column: 'title')
                //     ->ignore(id: request('task'), idColumn: 'id')
            ],
            'body' => [
                'required',
                'string',
                'max:500'
            ],
            'assigned_to_user_id' => [
                'required',
                'numeric',
                'min:0',
                'not_in:0'
            ],
        ];
    }

    public function messages(): array
    {
        return [
            // 'title.unique' => __('The task already exists.'),
            'assigned_to_user_id' => __('No valid user was assigned to the task.'),
        ];
    }
}
