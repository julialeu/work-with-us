<?php

use App\Http\Controllers\CreateCompanyController;
use App\Http\Controllers\CreateJobVacancyController;
use App\Http\Controllers\EditCompanyController;
use App\Http\Controllers\EditJobVacancyController;
use App\Http\Controllers\GetCompanyController;
use App\Http\Controllers\GetJobVacanciesController;
use App\Http\Controllers\GetJobVacancyController;
use App\Http\Controllers\GetMyCompaniesController;
use App\Http\Controllers\GetUserProfileController;
use App\Http\Controllers\MarkJobVacancyAsPublishedController;
use App\Http\Controllers\MarkJobVacancyAsUnpublishedController;
use App\Http\Controllers\PleaseLoginController;
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

    Route::get('please-login', PleaseLoginController::class)->name('pleaseLogin');
    Route::post('login', 'App\Http\Controllers\AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'App\Http\Controllers\AuthController@me');

    Route::post('register', RegisterUserController::class);
});


Route::group([

    'middleware' => 'private-api',
    'prefix' => 'api/user'

], function ($router) {
    Route::get('profile', GetUserProfileController::class);

    Route::post('job-vacancy', CreateJobVacancyController::class);
    Route::get('job-vacancies', GetJobVacanciesController::class);
    Route::get('job-vacancy', GetJobVacancyController::class);
    Route::patch('job-vacancy', EditJobVacancyController::class);

    Route::patch('mark-job-vacancy-as-published', MarkJobVacancyAsPublishedController::class);
    Route::patch('mark-job-vacancy-as-unpublished', MarkJobVacancyAsUnpublishedController::class);

    Route::get('my-companies', GetMyCompaniesController::class);
    Route::post('company', CreateCompanyController::class);
    Route::get('company', GetCompanyController::class);
    Route::patch('company', EditCompanyController::class);

});
