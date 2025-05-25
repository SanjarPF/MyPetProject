<?php
declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Containers\Authentication\Models\User;

class SpatiePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::query()->firstOrCreate([
            'name' => 'admin',
            'guard_name' => 'api',
        ]);

        $userRole = Role::query()->firstOrCreate([
            'name' => 'user',
            'guard_name' => 'api',
        ]);

        $permissions = ['view-users', 'edit-users', 'delete-users'];

        foreach ($permissions as $perm) {
            Permission::query()->firstOrCreate([
                'name' => $perm,
                'guard_name' => 'api',
            ]);
        }

        $adminRole->givePermissionTo($permissions);

        $admin = User::query()->first();
        if ($admin) {
            $admin->assignRole('admin');
        }

        $user = User::query()->skip(1)->first();
        if ($user) {
            $user->assignRole('user');
        }
    }
}
