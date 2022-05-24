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

Route::post('/login', [\App\Http\Controllers\UserController::class, 'login'])->name("login");
Route::post('/register', [\App\Http\Controllers\UserController::class, 'register']);

Route::group(['middleware' => 'auth'], function ($router) {
    Route::post('/logout', [\App\Http\Controllers\UserController::class, 'logout']);
    Route::post('/refresh', [\App\Http\Controllers\UserController::class, 'refresh']);
    Route::get('/user/profile', [\App\Http\Controllers\UserController::class, 'userProfile']);
    Route::get('invitations/me', [\App\Http\Controllers\InvitationController::class, 'myInvitation']);
    Route::apiResource('invitations', \App\Http\Controllers\InvitationController::class);
    Route::apiResource('invitations.expressions', \App\Http\Controllers\ExpressionController::class)->shallow()->withoutMiddleware('auth');
    Route::get('/expressions', [\App\Http\Controllers\ExpressionController::class, 'allExpressions']);
    Route::apiResource('themes', \App\Http\Controllers\ThemeController::class);
    Route::apiResource('invitations.events', \App\Http\Controllers\EventController::class)->shallow();
    Route::get('/events', [\App\Http\Controllers\EventController::class, 'allEvents']);
});
