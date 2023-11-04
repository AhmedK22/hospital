<?php


use Modules\Admin\Http\Controllers\Autn\AuthController;
use Illuminate\Support\Facades\Route;
use Modules\Appointment\Http\Controllers\AppointmentController;
use Modules\Doctor\Http\Controllers\DoctorController;
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


Route::prefix('admin')->group(function(){

    Route::post('/login', [AuthController::class, 'login']);

});
Route::post('/guest/appointments', [AppointmentController::class, 'create']);

Route::prefix('admin')->middleware('auth:sanctum')->group(function(){
    Route::get('/appointments', [AppointmentController::class, 'index']);
    Route::post('/appointments', [AppointmentController::class, 'create']);
    Route::patch('/appointments/update/{appointment}', [AppointmentController::class, 'update']);
    Route::delete('/appointments/delete/{appointment}', [AppointmentController::class, 'delete']);




    Route::get('/doctors', [DoctorController::class, 'index']);
    Route::post('/doctors', [DoctorController::class, 'create']);
    Route::patch('/doctors/update/{doctor}', [DoctorController::class, 'update']);
    Route::delete('/doctors/delete/{doctor}', [DoctorController::class, 'destroy']);


    Route::get('/patients', [PatientController::class, 'index']);
    Route::post('/patients', [PatientController::class, 'create']);
    Route::patch('/patients/update/{patient}', [PatientController::class, 'update']);
    Route::delete('/patients/delete/{patient}', [PatientController::class, 'destroy']);
});





