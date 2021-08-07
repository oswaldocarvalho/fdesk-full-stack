<?php

use App\Http\Controllers\Api\User\LoginController;
use App\Http\Controllers\Api\User\LogoutController;
use App\Http\Controllers\Api\User\RegisterController;
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

Route::prefix('users')->group(function ($route) {
    Route::post('/register', RegisterController::class)->name('user-register');
    Route::post('/login', LoginController::class)->name('user-login');

    Route::middleware('auth:api')->group(function () {
        Route::get('/logout', LogoutController::class)->name('user-logout');
    });
});
