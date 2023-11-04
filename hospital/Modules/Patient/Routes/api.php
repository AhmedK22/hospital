<?php

use Illuminate\Http\Request;
use Modules\Patient\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;
use Modules\Appointment\Http\Controllers\AppointmentController;
use Modules\Patient\Http\Controllers\PatientController;

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



Route::prefix('patient')->group(function(){
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

});

Route::prefix('patient')->middleware('auth:sanctum')->group(function(){

        Route::get('/appointments', [AppointmentController::class,'index']);

    Route::post('/appointment', [AppointmentController::class, 'create']);
});



