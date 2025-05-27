<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SpatiePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'view-users',
            'edit-users',
            'delete-users',
            'assign-roles',
        ];

        foreach ($permissions as $permission) {
            Permission::query()->firstOrCreate(['name' => $permission, 'guard_name' => 'api']);
        }

        $admin = Role::query()->firstOrCreate([
            'name' => 'admin',
            'guard_name' => 'api', // 👈
        ]);

        $moderator = Role::query()->firstOrCreate([
            'name' => 'moderator',
            'guard_name' => 'api',
        ]);

        $user = Role::query()->firstOrCreate([
            'name' => 'user',
            'guard_name' => 'api',
        ]);
        $admin->givePermissionTo(Permission::all());
        $moderator->givePermissionTo(['view-users', 'edit-users']);
    }
}
