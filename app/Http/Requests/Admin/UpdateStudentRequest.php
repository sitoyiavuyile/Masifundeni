<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()->isAdmin();
    }

    public function rules(): array
    {
        return [
            'name'          => ['required', 'string', 'max:255'],
            // Ignore this user's own email in the unique check
            'email'         => ['required', 'email', Rule::unique('users')->ignore($this->student)],
            'password'      => ['nullable', 'string', 'min:8', 'confirmed'],
            'phone'         => ['nullable', 'string', 'max:20'],
            'date_of_birth' => ['nullable', 'date', 'before:-18 years'],
            'address'       => ['nullable', 'string', 'max:500'],
            'status'        => ['required', 'in:active,suspended,graduated'],
        ];
    }
}
