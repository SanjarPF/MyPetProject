<?php
declare(strict_types=1);

namespace App\Containers\Authentication\Tasks;

use Spatie\Permission\Models\Permission;
use App\Containers\Authentication\Models\User;

class AssignPermissionsTask
{
    public function run(User $user, array $permissions): void
    {
        foreach ($permissions as $permName) {
            $permission = Permission::firstOrCreate([
                'name' => $permName,
                'guard_name' => 'api',
            ]);

            $user->givePermissionTo($permission);
        }
    }
}
