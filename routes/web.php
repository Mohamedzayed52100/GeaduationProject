<?php

use App\Http\Controllers\RelativeController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\RelativeSettingsController;
use App\Http\Controllers\LabAdminController;
use App\Http\Controllers\LabRequestController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ResetPassController;
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

Auth::routes();
Route::get('home', function () {
    session()->regenerate();
    session()->invalidate();
    return redirect('/');

});

//Logout for patient and doctor
Route::get('Logout', function () {
    session()->regenerate();
    session()->invalidate();
    return redirect('/');

});

//2 routes -> redirect to login
Route::get('doctorlogin', function () {
    return redirect('/login');
});
Route::get('patientlogin', function () {
    return redirect('/login');
});


Route::delete('/RelativeRequestLab/{id}', [RelativeSettingsController::class, 'RelativeRequestLab'])->name('notifications.delete');
Route::get('/viewImage/{file}', [RelativeController::class, 'ViewImages']);




/////////////////////////////////////////////////////////Relative and Lab Routes/////////////////////////////////////////////////////////////

//Request lab in patient interface
Route::middleware(PatientLoginMiddleware::class)->group(function () {
    //Payment 
    Route::group(['middleware' => 'patientPayment'], function () {
        Route::get('/LabPayment', [PaymentController::class, 'Payment']);
        Route::get('/LabPayment/Success', [PaymentController::class, 'PaymentCallBack']);
        Route::get('/LabPayment/Error', [PaymentController::class, 'PaymentError']);
    });


});


Route::group(['middleware' => 'PreventBackHistory'], function () {


    //main website route
    Route::get('/', [RelativeController::class, 'index']);


    //guest lab booking
    Route::get('/PatientOrRelative', [RelativeController::class, 'ShowPatientOrRelative']);
    Route::post('/PatientOrRelative', [RelativeController::class, 'PatientOrRelative']);
    Route::get('/welcome', [RelativeController::class, 'welcome']);

    //Machine Learning -> Survey
    Route::get('/Survey', [LabAdminController::class, 'ShowSurvey']);
    Route::post('/predict', [LabAdminController::class, 'Survey']);
    Route::group(['middleware' => 'patientSurvey'], function () {
        Route::get('/SurveyResult', [LabAdminController::class, 'ShowSurveyResult']);
    });


    //RelativeController
    Route::group(['middleware' => 'Approved'], function () {
        Route::get('/approval_form_after_mail', [RelativeController::class, 'show_approval_form_after_mail']);
        Route::post('/approval_form_after_mail', [RelativeController::class, 'approval_form_after_mail']);
    });

    //Guest
    Route::group(['middleware' => 'MyGuest'], function () {
        Route::get('/RegisterRelative', [RelativeController::class, 'showRegister']);
        Route::post('/RegisterRelative', [RelativeController::class, 'Register']);
        Route::group(['middleware' => 'Registered'], function () {
            Route::get('/patient_Approval', [RelativeController::class, 'ShowPatientApproval']);
            Route::post('/patient_Approval', [RelativeController::class, 'PatientApproval']);
        });

        Route::get('/loginRelative', [RelativeController::class, 'showLogin']);
        Route::post('/loginRelative', [RelativeController::class, 'Login']);
    });


    //Authenticated Relative (Logged in Relative)
    Route::group(['middleware' => 'RelativeAuth'], function () {
        //Logout
        Route::get('/logoutRelative', [RelativeController::class, 'logoutRelative']);

        //RelativeDashboard Controller

        Route::get('/Choose-Patient-Relative', [RelativeController::class, 'ShowChoosePatient']);
        Route::post('/Choose-Patient-Relative', [RelativeController::class, 'ChoosePatient']);

        Route::group(['middleware' => 'PatientIsSelectedAuth'], function () {
            Route::get('/Maps/{Latitude}/{Longitude}', [PaymentController::class, 'maps'])->name('maps.view');
            Route::get('/searchTests', [PaymentController::class, 'autocomplete'])->name('search_tests');
            Route::post('/LabRequest', [PaymentController::class, 'SendRequestLab']);

            Route::get('/RelativeLabResult', [RelativeSettingsController::class, 'ShowLabResult']);


            Route::get('/HomeRelative', [RelativeSettingsController::class, 'ShowHomeRelative']);
            Route::get('/settingsRelative', [RelativeSettingsController::class, 'ShowRelativeSettings']);
            Route::post('/settingsRelative', [RelativeSettingsController::class, 'RelativeSettings']);
            Route::get('/patient_profile_Relative', [RelativeSettingsController::class, 'patient_profile_Relative']);
            Route::get('/Doctor_profile_Relative', [RelativeSettingsController::class, 'Doctor_profile_Relative']);
            Route::get('/show_RelativeRequestLab', [RelativeSettingsController::class, 'show_RelativeRequestLab']);
            Route::get('/show_patient_list_Relative', [RelativeSettingsController::class, 'show_patient_list_Relative']);
            Route::delete('/patient_list_Relative/{id}', [RelativeSettingsController::class, 'patient_list_Relative'])
                ->name('patients.delete');
            Route::get('/add-patient-Relative', [RelativeSettingsController::class, 'Show_Add_Patient_Relative']);
            Route::post('/add-patient-Relative', [RelativeSettingsController::class, 'Add_Patient_Relative']);


        });
    });




    //////////////////////// lab routes  ////////////////////////


    // Guest
    Route::group(['middleware' => 'labguest'], function () {

        Route::get('/LabLogin', [LabAdminController::class, 'ShowLogin']);
        Route::post('/LabLogin', [LabAdminController::class, 'Login']);

        Route::get('/forgetPass', [ResetPassController::class, 'ShowForgetPass']);
        Route::post('/forgetPass', [ResetPassController::class, 'ForgetPass']);
        Route::get('/ResetPassword/{token}', [ResetPassController::class, 'ShowResetPass'])->name('password.reset');
        Route::post('/ResetPassword', [ResetPassController::class, 'ResetPass'])->name('password.update');
    });



    // Authenticated user (Logged in user)
    Route::group(['middleware' => 'labauth'], function () {

        Route::get('/LabLogout', [LabAdminController::class, 'LabLogout']);


        //Search
        Route::get('/LabSearch', [LabAdminController::class, 'ShowSearch']);
        Route::post('/Search', [LabAdminController::class, 'Search'])->name('search');
        Route::post('/Search/update', [LabAdminController::class, 'updateSearch']);
        Route::get('/LabSearch/viewImage/{file}', [LabAdminController::class, 'ViewImage']);
        Route::get('/searchPatient', [LabAdminController::class, 'SearchAutoComplete'])->name('search_patient');




        //Dashboard 'Request'
        Route::get('/LabDash', [LabRequestController::class, 'ShowDash']);
        Route::post('/LabDash/contact-user', [LabRequestController::class, 'ChatPopUp']);
        Route::get('/LabDash/AcceptRequest/{id}', [PaymentController::class, 'DashAccept']);
        Route::get('/LabDash/RejectRequest/{id}', [LabRequestController::class, 'DashReject']);




        //Upload 
        Route::get('/LabUploads', [LabRequestController::class, 'ShowUploads']);
        Route::post('/LabUploads', [LabRequestController::class, 'upload']);




        //Booked
        Route::get('/LabBookedAppointment', [LabRequestController::class, 'ShowCalendar']);
        Route::post('/LabBookedAppointment', [LabRequestController::class, 'AddNewAppointment'])->name('Add.Appointment');
        Route::patch('/LabBookedAppointment/UpdateAppointment/{id}', [LabRequestController::class, 'UpdateAppointment'])->name('Update.Appointment');
        Route::delete('/LabBookedAppointment/DeleteAppointment/{id}', [LabRequestController::class, 'DeleteAppointment'])->name('Delete.Appointment');
        Route::get('/AcceptBookedAppointment', [LabRequestController::class, 'AcceptAppointment']);
        Route::post('/LabBookedAppointment/edit', [LabRequestController::class, 'EditAppointment']);
        Route::get('/searchTest', [PaymentController::class, 'autocomplete'])->name('search_test');





        //Chat
        Route::get('/LabChat', [LabRequestController::class, 'ShowChat']);
    });


});