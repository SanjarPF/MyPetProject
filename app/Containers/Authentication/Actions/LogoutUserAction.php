<?php

declare(strict_types=1);

namespace App\Containers\Authentication\Actions;

use Illuminate\Contracts\Auth\Authenticatable;
use App\Containers\Authentication\Tasks\RevokeUserTokenTask;

class LogoutUserAction
{
    public function __construct(
        protected RevokeUserTokenTask $revokeUserTokenTask
    ) {}

    public function run(Authenticatable $user): void
    {
        $this->revokeUserTokenTask->run($user);
    }
}
