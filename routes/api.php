<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassServiceController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\TicketTypeController;
use App\Http\Controllers\PassangerTypeController;
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

    Route::post('ticket/create', [TicketTypeController::class, 'CreateOrUpdate']);
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


    Route::get('class-service', [ClassServiceController::class,'index']);
    Route::get('class-service/{id}', [ClassServiceController::class,'show']);
    Route::post('class-service/create', [ClassServiceController::class, 'createOrUpdate']);
    Route::delete('class-service/delete/{id}', [ClassServiceController::class, 'delete']);
  
    Route::post('passanger/create', [PassangerTypeController::class, 'createOrUpdate']);
    Route::get('passanger/delete/{id}', [PassangerTypeController::class, 'delete']);
    Route::get('passanger/show/{id}', [PassangerTypeController::class, 'show']);
    Route::get('passanger', [PassangerTypeController::class, 'index']);
  
      /**rutas de First Place Type */
Route::get('/first-place-types', [FirstPlaceTypeController::class, 'index']);
Route::post('/first-place-types', [FirstPlaceTypeController::class, 'store']);
Route::get('/first-place-types/{id}', [FirstPlaceTypeController::class, 'show']);
Route::put('/first-place-types/{id}', [FirstPlaceTypeController::class, 'update']);
Route::delete('/first-place-types/{id}', [FirstPlaceTypeController::class, 'destroy']);

});


Route::group([

    'middleware' => 'api',
    'prefix' => 'public'

], function ($router) {

    Route::get('trips', [PublicController::class, 'index']);

});

