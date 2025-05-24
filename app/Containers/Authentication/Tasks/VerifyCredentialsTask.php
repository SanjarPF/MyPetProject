<?php
declare(strict_types=1);

namespace App\Containers\Authentication\Tasks;

use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Validation\ValidationException;

class VerifyCredentialsTask
{
    /**
     * @throws ValidationException
     */
    public function run(string $email, string $password): Authenticatable
    {
        if (!Auth::attempt(['email' => $email, 'password' => $password])) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $user = Auth::user();

        if (!$user) {
            throw ValidationException::withMessages([
                'auth' => ['Authentication failed.'],
            ]);
        }

        return $user;
    }
}
