<?php

use App\Infrastructure\Controllers\GetEarlyAdopterController;
use App\Infrastructure\Controllers\GetGlobalProviderUsersController;
use App\Infrastructure\Controllers\GetUserController;
use App\Infrastructure\Controllers\GetUsersController;
use App\Infrastructure\Controllers\IsEarlyAdopterUserController;
use App\Infrastructure\Controllers\GetStatusController;
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


Route::get('/status', GetStatusController::class);
Route::get('/users/{email}', GetUserController::class);
Route::get('/users', GetUsersController::class);
Route::get('/users/early-adopter/{email}', GetEarlyAdopterController::class);
Route::get('/global-provider-users', GetGlobalProviderUsersController::class);

