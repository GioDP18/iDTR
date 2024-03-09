<?php

use App\Http\Controllers\AmDailyTimeRecordController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PmDailyTimeRecordController;
use App\Http\Controllers\GenerateDtrController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BreakTimeRecordController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);

    // API Endpoints for PM Time Records
    Route::post('/time-in-pm', [PmDailyTimeRecordController::class, 'timeInPM']);
    Route::post('/time-out-pm', [PmDailyTimeRecordController::class, 'timeOutPM']);
    Route::post('/get-time-record-pm', [PmDailyTimeRecordController::class, 'fetchTimePM']);

    // API Endpoints for AM Time Records
    Route::post('/time-in-am', [AmDailyTimeRecordController::class, 'timeInAM']);
    Route::post('/time-out-am', [AmDailyTimeRecordController::class, 'timeOutAM']);
    Route::post('/get-time-record-am', [AmDailyTimeRecordController::class, 'fetchTimeAM']);

    // API Endpoints for Generating Dtr
    Route::post('/generate', [GenerateDtrController::class, 'generate']);

    // API Endpoints for Report
    Route::post('/get-report', [ReportController::class, 'allReport']);
    Route::post('/create-report', [ReportController::class, 'createReport']);
    Route::post('/update-report', [ReportController::class, 'updateReport']);

    // Api Endpoints for User
    Route::get('/user/{userID}', [UserController::class, 'user']);

    // Api Endpoints for Break Time
    Route::get('/break/{userID}', [BreakTimeRecordController::class, 'allBreakTime']);
    Route::post('/create-break', [BreakTimeRecordController::class, 'addBreakTime']);

    // Api for dashboard
    Route::get('/dashboard/{id}', [UserController::class, 'dashboard']);
    Route::get('/activity-log', [UserController::class, 'activityLog']);

});
