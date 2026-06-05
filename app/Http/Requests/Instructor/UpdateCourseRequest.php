<?php

namespace App\Http\Requests\Instructor;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCourseRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Policy check is handled in the controller; here just confirm role
        return $this->user()->isInstructor();
    }

    public function rules(): array
    {
        $courseId = $this->route('course')->id;

        return [
            'title'       => ['required', 'string', 'min:3', 'max:255'],
            'code'        => [
                'required', 'string', 'max:10',
                'regex:/^[A-Za-z]{2,4}\d{2,4}$/',
                Rule::unique('courses', 'code')->ignore($courseId),
            ],
            'description' => ['nullable', 'string', 'max:2000'],
            'status'      => ['required', 'in:draft,published,archived'],
            'credits'     => ['required', 'integer', 'min:0', 'max:10'],
        ];
    }

    public function messages(): array
    {
        return [
            'code.regex'  => 'Course code must be 2-4 letters followed by 2-4 digits (e.g. CS101).',
            'code.unique' => 'This course code is already taken.',
        ];
    }
}
