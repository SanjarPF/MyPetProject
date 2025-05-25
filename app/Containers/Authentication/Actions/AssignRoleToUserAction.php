<?php
declare(strict_types=1);

namespace App\Containers\Authentication\Actions;

use App\Containers\Authentication\Tasks\AssignRoleTask;
use App\Containers\Authentication\Tasks\FindUserByIdTask;

class AssignRoleToUserAction
{
    public function __construct(
        protected FindUserByIdTask $findUserByIdTask,
        protected AssignRoleTask $assignRoleTask,
    ) {}

    public function run(int $userId, string $role): void
    {
        $user = $this->findUserByIdTask->run($userId);
        $this->assignRoleTask->run($user, $role);
    }
}

