<?php

use App\Http\Controllers\Api\User\LoginController;
use App\Http\Controllers\Api\User\RegisterController;
use Fruitcake\Cors\HandleCors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(HandleCors::class)->prefix('users')->group(function () {
    Route::post('/register', RegisterController::class)->name('user-register');
    Route::post('/login', LoginController::class)->name('user-login');
});
