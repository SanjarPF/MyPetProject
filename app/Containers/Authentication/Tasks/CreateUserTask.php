<?php

declare(strict_types=1);

namespace App\Containers\Authentication\Tasks;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateUserTask
{
    public function run(string $name, string $email, string $password): User
    {
        $user = new User;
        $user->name = $name;
        $user->email = $email;
        $user->password = Hash::make($password);
        $user->save();

        return $user;
    }
}
