<?php

declare(strict_types=1);

namespace App\Containers\Authentication\UI\API\Controllers;

use Illuminate\Http\JsonResponse;
use App\Containers\Authentication\Actions\LoginUserAction;
use App\Containers\Authentication\UI\API\Requests\LoginRequest;

class LoginController
{
    public function __invoke(LoginRequest $request, LoginUserAction $action): JsonResponse
    {
        $token = $action->run(
            email: $request->input('email'),
            password: $request->input('password'),
        );

        return response()->json([
            'token' => $token,
        ]);
    }
}
