<?php

declare(strict_types=1);

namespace App\Containers\Authentication\Actions;

use App\Containers\Authentication\Tasks\FindUserByIdTask;
use App\Containers\Authentication\Tasks\AssignPermissionsTask;

class AssignPermissionsToUserAction
{
    public function __construct(
        protected FindUserByIdTask $findUserByIdTask,
        protected AssignPermissionsTask $assignPermissionsTask,
    ) {}

    public function run(int $userId, array $permissions): void
    {
        $user = $this->findUserByIdTask->run($userId);
        $this->assignPermissionsTask->run($user, $permissions);
    }
}
