<?php

declare(strict_types=1);

namespace App\Containers\Authentication\UI\API\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssignPermissionsToUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'permissions' => ['required', 'array'],
            'permissions.*' => ['string'],
        ];
    }
}
