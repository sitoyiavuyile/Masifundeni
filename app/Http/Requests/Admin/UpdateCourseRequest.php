<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCourseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->isAdmin();
    }

    public function rules(): array
    {
        $courseId = $this->route('course')->id;

        return [
            'user_id'     => ['required', 'exists:users,id'],
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
}
