<?php

use App\Http\Controllers\AmDailyTimeRecordController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PmDailyTimeRecordController;
use App\Http\Controllers\GenerateDtrController;
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
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);   

    // API Endpoints for PM Time Records
    Route::post('/time-in-pm', [PmDailyTimeRecordController::class, 'timeInPM']);
    Route::post('/time-out-pm', [PmDailyTimeRecordController::class, 'timeOutPM']);
    Route::post('/get-time-record-pm', [PmDailyTimeRecordController::class, 'getTimePM']);

    // API Endpoints for AM Time Records
    Route::post('/time-in-am', [AmDailyTimeRecordController::class, 'timeInAM']);
    Route::post('/time-out-am', [AmDailyTimeRecordController::class, 'timeOutAM']);
    Route::post('/get-time-record-am', [AmDailyTimeRecordController::class, 'fetchTimeAM']);

    // API Endponts for Generating Dtr
    Route::post('/generate', [GenerateDtrController::class, 'generate']);
});
