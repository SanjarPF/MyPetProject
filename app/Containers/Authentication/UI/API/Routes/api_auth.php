<?php
declare(strict_types=1);

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
