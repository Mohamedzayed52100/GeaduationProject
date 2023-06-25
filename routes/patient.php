<?php

use App\Http\Controllers\PatientController;
use App\Http\Controllers\ReportPDFController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\PatientLoginMiddleware;

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
/* patient */

Route::middleware(PatientLoginMiddleware::class)->group(function(){ 


    Route::controller(PatientController::class)->group(function(){

        //Welcome Page
        Route::any('welcome' ,'welcome');

        //Advices view
        Route::any('HomePatient' ,'HomePatient');


        //Patient Charts
        Route::any('patient_reports' ,'patient_reports');


        //Choose disease
        Route::any('choose_disease' ,'choose_disease');
        Route::any('PatientRequestDisease/{disease}' ,'PatientRequestDisease');
        Route::any('DiseaseApproval' ,'DiseaseApproval');
        Route::any('DiseaseDecline' ,'DiseaseDecline');
        Route::any('RequestConfirmation' ,'RequestConfirmation');




        //Measure Vital Signs
        Route::any('Sensormeasurement' ,'Sensormeasurement');
        Route::get('Sensor' ,'Sensor');
        Route::any('measurement' ,'measurement');
        Route::any('measurementResult' , 'measurementResult');
        Route::any('PatientResult' ,'PatientResult');


        

        //Patient Request Lab
        Route::any('PatientRequestLab' ,'PatientRequestLab');
        Route::get('/Map/{Latitude}/{Longitude}', 'maps')->name('map.view');
        Route::get('/searchTest' , 'autocomplete')->name('search_test');
        Route::post('/RequestLab', 'SendRequestLab');


        //Patient Profile
        Route::any('Patientprofile' ,'Patientprofile');
        Route::any('change_g_info' ,'change_g_info');
        Route::any('change_patient_password' ,'change_patient_password');


        //Patient Relatives list
        Route::any('relative_list_patient' ,'relative_list_patient');
        Route::any('removeRelative/{id}' ,'removeRelative');


        //Zoom
        Route::any('zoomMeetingpatient' ,[PatientController::class , 'zoomMeetingpatient']);



    });



    //Download PDF --> TEST
    Route::get('/pdf', [ReportPDFController ::class, 'index'])->name('index');

}); 



Auth::routes();







