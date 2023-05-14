<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TicketTypeController;
use App\Http\Controllers\PassangerTypeController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::get('me', [AuthController::class, 'me']);
    Route::post('register', [AuthController::class, 'register']);

    Route::post('ticket/create', [TicketTypeController::class, 'CreateOrUpdate']);
    Route::get('ticket/delete/{id}', [TicketTypeController::class, 'delete']);

    Route::post('passanger/create', [PassangerTypeController::class, 'createOrUpdate']);
    Route::get('passanger/delete/{id}', [PassangerTypeController::class, 'delete']);
    Route::get('passanger/show/{id}', [PassangerTypeController::class, 'show']);
    Route::get('passanger', [PassangerTypeController::class, 'index']);
});