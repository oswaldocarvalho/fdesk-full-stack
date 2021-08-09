<?php

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
    Route::post('/register', \App\Http\Controllers\Api\User\RegisterController::class)->name('user-register');
    Route::post('/login', \App\Http\Controllers\Api\User\LoginController::class)->name('user-login');

    Route::middleware('auth:api')->group(function () {
        Route::get('/logout', \App\Http\Controllers\Api\User\LogoutController::class)->name('user-logout');
    });
});

Route::prefix('todos')->middleware('auth:api')->group(function ($route) {
    Route::post('/', \App\Http\Controllers\Api\Todo\AddController::class)->name('todo-add');
    Route::get('/', \App\Http\Controllers\Api\Todo\ListController::class)->name('todo-list');
    Route::patch('/{id}', \App\Http\Controllers\Api\Todo\UpdateController::class)->name('todo-update');
    Route::delete('/{id}', \App\Http\Controllers\Api\Todo\DeleteController::class)->name('todo-delete');

    Route::patch('/{id}/toggle-completed', \App\Http\Controllers\Api\Todo\ToggleCompletedController::class)->name('todo-update');
});


