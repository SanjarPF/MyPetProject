<?php
declare(strict_types=1);

use App\Containers\Authentication\Models\User;
use Illuminate\Support\Facades\Route;
use App\Containers\Authentication\UI\API\Controllers\LoginController;
use App\Containers\Authentication\UI\API\Controllers\LogoutController;
use App\Containers\Authentication\UI\API\Controllers\RegisterController;
use App\Containers\Authentication\UI\API\Controllers\ResetPasswordController;
use App\Containers\Authentication\UI\API\Controllers\ForgotPasswordController;

Route::prefix('auth')->group(function () {
    Route::post('register', RegisterController::class);
    Route::post('login', LoginController::class);
    Route::post('logout', LogoutController::class)->middleware('auth:sanctum');

    Route::post('forgot-password', ForgotPasswordController::class);
    Route::post('reset-password', ResetPasswordController::class);
});


Route::middleware(['auth:sanctum', 'role:admin'])->get('/admin-only', function () {
    return response()->json(['message' => 'Hello, admin!']);
});

Route::middleware(['auth:sanctum', 'permission:view-users'])->get('/view-users', function () {
    return response()->json(['message' => 'You can view users.']);
});

Route::post('/users/{id}/assign-role', function (User $user) {
    $user->assignRole('admin');
    return response()->json(['message' => 'Role assigned']);
});

