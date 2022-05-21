<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your \Application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'auth'], function ($router) {
    Route::group(['prefix' => 'auth'], function ($router){
        Route::post('/login', [\App\Http\Controllers\UserController::class, 'login'])->withoutMiddleware('auth');
        Route::post('/register', [\App\Http\Controllers\UserController::class, 'register'])->withoutMiddleware('auth');
        Route::post('/logout', [\App\Http\Controllers\UserController::class, 'logout']);
        Route::post('/refresh', [\App\Http\Controllers\UserController::class, 'refresh']);
        Route::get('/user-profile', [\App\Http\Controllers\UserController::class, 'userProfile']);
    });
    Route::apiResource('invitations', \App\Http\Controllers\InvitationController::class);
    Route::apiResource('invitations.congratulations', \App\Http\Controllers\CongratulationController::class)->shallow();
    Route::apiResource('inviatationThemes', \App\Http\Controllers\InvitationThemeController::class);
});
