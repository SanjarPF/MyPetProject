<?php

declare(strict_types=1);

namespace App\Containers\Authentication\Tasks;

use App\Models\User;

class FindUserByIdTask
{
    public function run(int $id): User
    {
        return User::query()->findOrFail($id);
    }
}
