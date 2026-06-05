<?php

namespace App\Http\Requests\Instructor;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEnrolmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        $enrolment = $this->route('enrolment');
        return auth()->user()->isInstructor()
            && $enrolment->course->instructor_id === auth()->id();
    }

    public function rules(): array
    {
        return [
            'status' => ['required', 'in:pending,active,completed,dropped'],
        ];
    }

    public function messages(): array
    {
        return [
            'status.in' => 'Status must be pending, active, completed, or dropped.',
        ];
    }
}
