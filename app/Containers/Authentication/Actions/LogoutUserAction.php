<?php

declare(strict_types=1);

namespace App\Containers\Authentication\Actions;

use App\Containers\Authentication\Tasks\RevokeUserTokenTask;
use Illuminate\Contracts\Auth\Authenticatable;

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
