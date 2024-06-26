<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskStatusRequest extends FormRequest
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
            'post_task_id' => [
                'required',
                'numeric',
                'min:0',
                'not_in:0'
            ],
            'status_id' => [
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
            'post_task_id' => __('No valid task was passed to update its status.'),
            'status_id' => __('No valid status was passed to assign to the task.'),
        ];
    }
}
