<?php
declare(strict_types=1);

namespace App\Containers\Authentication\Tasks;

use App\Containers\Authentication\Models\User;

class CreateUserTask
{
    public function run(string $name, string $email, string $password): User
    {
        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password = $password;
        $user->save();

        return $user;
    }
}
