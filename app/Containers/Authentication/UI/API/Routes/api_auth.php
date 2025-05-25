<?php
declare(strict_types=1);

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Route;
use App\Containers\Authentication\Models\User;
use App\Containers\Authentication\UI\API\Controllers\LoginController;
use App\Containers\Authentication\UI\API\Controllers\LogoutController;
use App\Containers\Authentication\UI\API\Controllers\RegisterController;
use App\Containers\Authentication\UI\API\Controllers\ResetPasswordController;
use App\Containers\Authentication\UI\API\Controllers\ForgotPasswordController;
use App\Containers\Authentication\UI\API\Controllers\AssignRoleToUserController;
use App\Containers\Authentication\UI\API\Controllers\GetAuthenticatedUserController;
use App\Containers\Authentication\UI\API\Controllers\AssignPermissionsToUserController;

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

Route::post('/users/{id}/assign-role', function (Request $request, User $user) {
    $roleName = $request->input('role');

    // Найдём или создадим роль с guard_name 'api'
    $role = Role::firstOrCreate([
        'name' => $roleName,
        'guard_name' => 'api',
    ]);

    $permissions = ['view-users', 'edit-users'];
    $role->syncPermissions($permissions);

    // Назначим роль пользователю
    $user->assignRole($role);

    return response()->json([
        'message' => "Роль '{$roleName}' назначена пользователю {$user->email}",
        'roles' => $user->getRoleNames(),
        'permissions' => $user->getPermissionNames(),
    ]);
});

Route::prefix('users')->middleware('auth:sanctum')->group(function () {
    Route::post('{id}/assign-role', AssignRoleToUserController::class);
    Route::post('{id}/assign-permission', AssignPermissionsToUserController::class);
});
