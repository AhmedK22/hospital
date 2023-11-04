<?php

use Illuminate\Support\Facades\Route;
use Modules\Appointment\Http\Controllers\AppointmentController;
use Modules\Doctor\Http\Controllers\Autn\AuthController;

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

Route::prefix('doctor')->post('/login', [AuthController::class,'login']);


Route::prefix('doctor')->middleware('auth:sanctum')->group(function(){
    Route::get('/appointments',[AppointmentController::class,'index']);
    Route::patch('/appointments/update/{appointment}',[AppointmentController::class,'update']);
});
