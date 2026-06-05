<?php

namespace App\Http\Requests\Instructor;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEnrolmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->isInstructor();
    }

    public function rules(): array
    {
        return [
            'status' => ['required', 'in:pending,active,completed,dropped'],
            'grade'  => ['nullable', 'numeric', 'min:0', 'max:100'],
        ];
    }

    public function messages(): array
    {
        return [
            'grade.min' => 'Grade cannot be negative.',
            'grade.max' => 'Grade cannot exceed 100.',
        ];
    }

    /** Only allow grade when status is completed */
    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            $status = $this->input('status');
            $grade  = $this->input('grade');

            if ($grade !== null && $status !== 'completed') {
                $validator->errors()->add(
                    'grade',
                    'A grade can only be assigned when the status is "completed".'
                );
            }
        });
    }
}
