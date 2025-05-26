<?php
declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

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
