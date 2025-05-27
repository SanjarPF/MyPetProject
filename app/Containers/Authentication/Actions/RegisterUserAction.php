<?php

declare(strict_types=1);

namespace App\Containers\Authentication\Actions;

use App\Containers\Authentication\Tasks\CreateUserTask;
use App\Ship\Events\UserRegisteredEvent;

class RegisterUserAction
{
    public function __construct(
        protected CreateUserTask $createUserTask
    ) {}

    public function run(string $name, string $email, string $password): string
    {
        $user = $this->createUserTask->run($name, $email, $password);
        event(new UserRegisteredEvent($user));

        return $user->createToken('API Token')->plainTextToken;
    }
}
