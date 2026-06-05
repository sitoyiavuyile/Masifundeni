<?php
// app/Http/Requests/Instructor/UpdateCourseRequest.php

namespace App\Http\Requests\Instructor;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCourseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()->isInstructor() || auth()->user()->isAdmin();
    }

    public function rules(): array
    {
        return [
            'title'         => ['required', 'string', 'max:255'],
            'description'   => ['nullable', 'string'],
            'status'        => ['required', 'in:draft,published,archived'],
            'instructor_id' => ['nullable', 'exists:users,id'],
        ];
    }
}