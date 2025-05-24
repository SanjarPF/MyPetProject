<?php
declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Containers\Authentication\UI\API\Controllers\LoginController;
use App\Containers\Authentication\UI\API\Controllers\RegisterController;

Route::post('/auth/register', RegisterController::class);
Route::post('/auth/login', LoginController::class);

