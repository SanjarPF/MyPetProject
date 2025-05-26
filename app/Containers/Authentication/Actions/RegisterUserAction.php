<?php
declare(strict_types=1);

namespace App\Containers\Authentication\Actions;

use App\Ship\Jobs\SendWelcomeEmailJob;
use App\Containers\Authentication\Tasks\CreateUserTask;

class RegisterUserAction
{
    public function __construct(
        protected CreateUserTask $createUserTask
    ) {}

    public function run(string $name, string $email, string $password): string
    {
        $user = $this->createUserTask->run($name, $email, $password);

        SendWelcomeEmailJob::dispatch($user);

        return $user->createToken('API Token')->plainTextToken;
    }
}
