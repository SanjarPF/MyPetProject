<?php
declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Containers\Authentication\Models\User;

class SanctumTestSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        $token = $user->createToken('PostmanToken')->plainTextToken;

        echo "=====================\n";
        echo "TOKEN: $token\n";
        echo "EMAIL: {$user->email}\n";
        echo "PASSWORD: password\n";
        echo "=====================\n";
    }
}
