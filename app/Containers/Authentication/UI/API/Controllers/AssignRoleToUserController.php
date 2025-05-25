<?php
declare(strict_types=1);

namespace App\Containers\Authentication\UI\API\Controllers;

use Illuminate\Http\JsonResponse;
use App\Containers\Authentication\Actions\AssignRoleToUserAction;
use App\Containers\Authentication\UI\API\Requests\AssignRoleToUserRequest;

class AssignRoleToUserController
{
    public function __invoke(AssignRoleToUserRequest $request, AssignRoleToUserAction $assignRoleToUserAction, int $id): JsonResponse
    {
        $assignRoleToUserAction->run($id, $request->input('role'));

        return response()->json(['message' => 'Role assigned successfully.']);
    }
}
