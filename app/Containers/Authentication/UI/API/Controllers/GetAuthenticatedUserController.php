<?php

declare(strict_types=1);

namespace App\Containers\Authentication\UI\API\Controllers;

use App\Containers\Authentication\Actions\GetAuthenticatedUserAction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GetAuthenticatedUserController
{
    public function __invoke(Request $request, GetAuthenticatedUserAction $authenticatedUserAction): JsonResponse
    {
        return response()->json($authenticatedUserAction->run($request));
    }
}
