<?php

use App\Http\Controllers\Site\ShowCompanyPageController;

use App\Http\Controllers\Site\ShowJobVacancyPageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('dummy', 'App\Http\Controllers\DummyController@execute');

Route::get('{companySlug}', ShowCompanyPageController::class);

Route::get('{companySlug}/{urlToken}', ShowJobVacancyPageController::class);

include 'api.php';

