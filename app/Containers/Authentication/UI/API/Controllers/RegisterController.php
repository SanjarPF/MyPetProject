<?php

declare(strict_types=1);

namespace App\Containers\Authentication\UI\API\Controllers;

use Illuminate\Http\JsonResponse;
use App\Containers\Authentication\Actions\RegisterUserAction;
use App\Containers\Authentication\UI\API\Requests\RegisterRequest;

class RegisterController
{
    public function __invoke(RegisterRequest $request, RegisterUserAction $action): JsonResponse
    {
        $token = $action->run(
            name: $request->input('name'),
            email: $request->input('email'),
            password: $request->input('password')
        );

        return response()->json([
            'token' => $token,
        ]);
    }
}
