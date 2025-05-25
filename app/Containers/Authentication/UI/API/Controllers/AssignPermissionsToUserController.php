<?php
declare(strict_types=1);

namespace App\Containers\Authentication\UI\API\Controllers;

use Illuminate\Http\JsonResponse;
use App\Containers\Authentication\Actions\AssignPermissionsToUserAction;
use App\Containers\Authentication\UI\API\Requests\AssignPermissionsToUserRequest;

class AssignPermissionsToUserController
{
    public function __invoke(AssignPermissionsToUserRequest $request, AssignPermissionsToUserAction $action, int $id): JsonResponse
    {
        $action->run($id, $request->input('permissions'));

        return response()->json(['message' => 'Permissions assigned successfully.']);
    }
}
