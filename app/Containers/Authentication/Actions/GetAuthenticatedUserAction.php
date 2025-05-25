<?php
declare(strict_types=1);

namespace App\Containers\Authentication\Actions;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class GetAuthenticatedUserAction
{
    public function run(Request $request): Collection
    {
        $user = $request->user();

        if (!$user) {
            abort(401, 'Unauthenticated.');
        }

        return collect([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'roles' => $user->getRoleNames(),
            'permissions' => $user->getPermissionNames(),
        ]);
    }
}
