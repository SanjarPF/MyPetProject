<?php

declare(strict_types=1);

namespace App\Containers\Authentication\Tasks;

use App\Models\User;
use Spatie\Permission\Models\Permission;

class AssignPermissionsTask
{
    public function run(User $user, array $permissions): void
    {
        foreach ($permissions as $permName) {
            $permission = Permission::query()->firstOrCreate([
                'name' => $permName,
                'guard_name' => 'api',
            ]);

            $user->givePermissionTo($permission);
        }
    }
}
