<?php

declare(strict_types=1);

namespace App\Containers\Authentication\Actions;

use App\Containers\Authentication\Tasks\VerifyCredentialsTask;

class LoginUserAction
{
    public function __construct(
        protected VerifyCredentialsTask $verifyCredentialsTask
    ) {}

    public function run(string $email, string $password): string
    {
        $user = $this->verifyCredentialsTask->run($email, $password);

        return $user->createToken('auth_token')->plainTextToken;
    }
}
