<?php

use App\Http\Controllers\CreateJobVacancyController;
use App\Http\Controllers\GetJobVacanciesController;
use App\Http\Controllers\GetUserProfileController;
use App\Http\Controllers\RegisterUserController;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::group([

    'middleware' => 'api',
    'prefix' => 'api/auth'

], function ($router) {

    Route::post('login', 'App\Http\Controllers\AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'App\Http\Controllers\AuthController@me');

    Route::post('register', RegisterUserController::class);

    Route::get('profile', GetUserProfileController::class);

    Route::post('job-vacancy', CreateJobVacancyController::class);

    Route::get('job-vacancies', GetJobVacanciesController::class);

});
