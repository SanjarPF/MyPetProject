<?php

declare(strict_types=1);

namespace App\Containers\Authentication\UI\API\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Containers\Authentication\Actions\GetAuthenticatedUserAction;

class GetAuthenticatedUserController
{
    public function __invoke(Request $request, GetAuthenticatedUserAction $authenticatedUserAction): JsonResponse
    {
        return response()->json($authenticatedUserAction->run($request));
    }
}
