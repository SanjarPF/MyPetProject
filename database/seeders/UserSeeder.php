<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::query()->firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('admin123'),
            ]
        );
        $admin->assignRole('admin');

        $moderator = User::query()->firstOrCreate(
            ['email' => 'moderator@example.com'],
            [
                'name' => 'Moderator',
                'password' => Hash::make('moderator123'),
            ]
        );
        $moderator->assignRole('moderator');

        User::factory()
            ->count(5)
            ->create()
            ->each(fn ($user) => $user->assignRole('user'));
    }
}
