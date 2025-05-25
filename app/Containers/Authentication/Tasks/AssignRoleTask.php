<?php
declare(strict_types=1);

namespace App\Containers\Authentication\Tasks;

use Spatie\Permission\Models\Role;
use App\Containers\Authentication\Models\User;

class AssignRoleTask
{
    public function run(User $user, string $roleName): void
    {
        $role = Role::query()->firstOrCreate([
            'name' => $roleName,
            'guard_name' => 'api',
        ]);

        $user->assignRole($role);
    }
}
