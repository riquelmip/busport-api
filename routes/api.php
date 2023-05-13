<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\TicketTypeController;
use App\Http\Controllers\TripController;
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

    Route::post('ticket/create', [TicketTypeController::class, 'createOrUpdate']);
    Route::get('ticket/delete/{id}', [TicketTypeController::class, 'delete']);
    Route::get('ticket', [TicketTypeController::class, 'index']);
    Route::get('ticket/{id}', [TicketTypeController::class, 'show']);

    Route::post('trip/create', [TripController::class, 'createOrUpdate']);
    Route::get('trip/delete/{id}', [TripController::class, 'delete']);
    Route::get('trip', [TripController::class, 'index']);
    Route::get('trip/{id}', [TripController::class, 'show']);

    Route::get('countries', [CountryController::class,'index']);//GET
    //http://127.0.0.1:8000/api/auth/countries
    Route::get('countries/{CountryId}', [CountryController::class,'show']);//GET primero crear un registro
    //http://127.0.0.1:8000/api/auth/countries/2
    Route::post('countries/create', [CountryController::class, 'createOrUpdate']);//POST
    // http://127.0.0.1:8000/api/auth/countries/create
    // http://127.0.0.1:8000/api/auth/countries/create
    // |key  | value     |
    // |name | Mexico    |
    Route::delete('countries/delete/{id}', [CountryController::class, 'delete']);//DELETE
    //http://127.0.0.1:8000/api/auth/countries/delete/1
});