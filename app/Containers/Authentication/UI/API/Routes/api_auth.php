<?php

declare(strict_types=1);

use App\Containers\Authentication\UI\API\Controllers\AssignPermissionsToUserController;
use App\Containers\Authentication\UI\API\Controllers\AssignRoleToUserController;
use App\Containers\Authentication\UI\API\Controllers\ForgotPasswordController;
use App\Containers\Authentication\UI\API\Controllers\GetAuthenticatedUserController;
use App\Containers\Authentication\UI\API\Controllers\LoginController;
use App\Containers\Authentication\UI\API\Controllers\LogoutController;
use App\Containers\Authentication\UI\API\Controllers\RegisterController;
use App\Containers\Authentication\UI\API\Controllers\ResetPasswordController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('register', RegisterController::class);
    Route::post('login', LoginController::class);
    Route::post('logout', LogoutController::class)->middleware('auth:sanctum');

    Route::post('forgot-password', ForgotPasswordController::class);
    Route::post('reset-password', ResetPasswordController::class);

    Route::get('me', GetAuthenticatedUserController::class)->middleware('auth:sanctum');
});

Route::middleware(['auth:sanctum', 'role:admin'])->get('/admin-only', function () {
    return response()->json(['message' => 'Hello, admin!']);
});

Route::middleware(['auth:sanctum', 'permission:view-users'])->get('/view-users', function () {
    return response()->json(['message' => 'You can view users.']);
});

Route::prefix('users')->middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::post('{id}/assign-role', AssignRoleToUserController::class);
    Route::post('{id}/assign-permission', AssignPermissionsToUserController::class);
});
