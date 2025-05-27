<?php

declare(strict_types=1);

namespace App\Containers\Authentication\UI\API\Controllers;

use App\Containers\Authentication\Actions\LogoutUserAction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LogoutController
{
    public function __invoke(Request $request, LogoutUserAction $logoutUserAction): JsonResponse
    {
        $user = $request->user();

        if (! $user) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        $logoutUserAction->run($user);

        return response()->json([
            'message' => 'Logged out successfully.',
        ]);
    }
}
