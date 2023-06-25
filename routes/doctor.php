<?php

use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ZoomController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


use App\Http\Middleware\DoctorLoginMiddleware;

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



/* Doctor */



Route::middleware(DoctorLoginMiddleware::class)->group(function () {


    Route::view('Doctormessage', 'doctor_pages.Doctormessages');
    Route::view('DoctorProfile', 'doctor_pages.DoctorProfile');
    Route::view('emergencyList', 'doctor_pages.emergencyList');
    Route::view('HomeDoctor', 'doctor_pages.HomeDoctor');
    Route::view('lock-screen', 'doctor_pages.lock-screen');
    Route::view('loginDoctor', 'doctor_pages.loginDoctor');
    Route::view('medicalrecord_Doctor', 'doctor_pages.medicalrecord_Doctor');


    //Doctor Dashboard
    Route::get('HomeDoctor', [DoctorController::class, 'HomeDoctor']);


    //Doctor Profile
    Route::any('DoctorProfile', [DoctorController::class, 'DoctorProfile']);
    Route::match(['get', 'post'], 'editDoctorPersonalInfo', [DoctorController::class, 'editDoctorPersonalInfo']);
    Route::any('changeDoctorPassword', [DoctorController::class, 'changeDoctorPassword']);


    //Patients' List
    Route::get('patientListDoctor', [DoctorController::class, 'showPatientList']);
    Route::get('patients/list', [DoctorController::class, 'getPatientList'])->name('patients.list');

    //Lock Screen
    Route::match(['get', 'post'], 'lockscreensubmit', [DoctorController::class, 'lockscreensubmit']);


    //Emergency list
    Route::any('emergencyList', [DoctorController::class, 'emergencyList']);

    //Medical Record 
    Route::get('medicalrecord_Doctor/{id}', [DoctorController::class, 'medicalrecord_Doctor']);
    Route::any('medicalrecord_Doctor_submit', [DoctorController::class, 'medicalrecord_Doctor_submit']);

    //Zoom Meeting
    Route::get('zoomDoctor', [DoctorController::class, 'zoomDoctor']);
    Route::post('/zoom/schedule', [ZoomController::class, 'scheduleMeeting'])->name('zoom.schedule');


});



Auth::routes();