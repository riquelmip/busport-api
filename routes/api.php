<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TicketTypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FirstPlaceTypeController;

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

    Route::post('ticket/create', [TicketTypeController::class, 'createOrUpdate']);
    Route::get('ticket/delete/{id}', [TicketTypeController::class, 'delete']);


    /**rutas de First Place Type */
Route::get('/first-place-types', [FirstPlaceTypeController::class, 'index']);
Route::post('/first-place-types', [FirstPlaceTypeController::class, 'store']);
Route::get('/first-place-types/{id}', [FirstPlaceTypeController::class, 'show']);
Route::put('/first-place-types/{id}', [FirstPlaceTypeController::class, 'update']);
Route::delete('/first-place-types/{id}', [FirstPlaceTypeController::class, 'destroy']);

});
