<?php

declare(strict_types=1);

namespace App\Containers\Authentication\UI\API\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'exists:users,email'],
            'token' => ['required', 'string'],
            'password' => ['required', 'confirmed', 'min:8'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
