<?php

declare(strict_types=1);

namespace App\Containers\Authentication\Tasks;

use Illuminate\Contracts\Auth\Authenticatable;

class RevokeUserTokenTask
{
    public function run(Authenticatable $user): void
    {
        $user->currentAccessToken()->delete();
    }
}
