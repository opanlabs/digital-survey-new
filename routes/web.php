<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterSurveyController;
use App\Http\Controllers\RegisterClaimController;
use App\Http\Controllers\PartController;
use App\Http\Controllers\TypePartController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\AutoDeployController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\TeamController;

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

// $delete = \Storage::path("public/images/photo-profile-3.jpeg");

Route::group(['prefix' => 'dashboard', 'middleware' => ['auth']], function(){
    Route::get('/main',[DashboardController::class,'index'])->name('dashboard');
    Route::get('/profile',[ProfileController::class,'index'])->name('profile');
    Route::put('/profile/edit/{id}',[ProfileController::class,'update'])->name('profile.edit');
    // register survey
    Route::get('/register-survey',[RegisterSurveyController::class,'index'])->name('register-risk-survey');
    Route::get('/register-survey/list-report',[RegisterSurveyController::class,'report'])->name('register-risk-survey.report-list');
    Route::post('/register-survey/send-email',[RegisterSurveyController::class,'send_email'])->name('register-survey.send-email');
    Route::post('/register-survey',[RegisterSurveyController::class,'store'])->name('register-survey.create');
    Route::put('/register-survey/edit/{id}',[RegisterSurveyController::class,'update'])->name('register-survey.update');
    Route::post('/register-survey/schedule',[RegisterSurveyController::class,'updateSchedule'])->name('register-survey.schedule');
    Route::post('/register-survey/report',[RegisterSurveyController::class,'reportSchedule'])->name('register-survey.report');
    Route::post('/register-survey/ajax',[RegisterSurveyController::class,'ajaxUploadVideo'])->name('register-survey.ajaxUploadVideo');
    Route::post('/register-survey/delete',[RegisterSurveyController::class,'deleteSurvey'])->name('register-survey.deleteSurvey');
    Route::post('/register-survey/detail',[RegisterSurveyController::class, 'detailSurvey'])->name('register-survey.details');
    Route::get('/register-survey/export_excel/{id}', [RegisterSurveyController::class, 'export_excel']);
    Route::post('/register-survey/export_excel/report', [RegisterSurveyController::class, 'export_excel_survey_summary_report'])->name('register-survey.export_excel_survey_summary_report');
    Route::post('/register-survey/export_excel', [RegisterSurveyController::class, 'export_excel_survey_summary'])->name('register-survey.export_excel_survey_summary');
    Route::get('/register-survey/export_pdf/{id}', [RegisterSurveyController::class, 'export_pdf']);

    // register claim
    Route::get('/register-claim',[RegisterClaimController::class,'index'])->name('register-claim');
    Route::get('/register-claim/list-report',[RegisterClaimController::class,'report'])->name('register-claim.report-list');
    Route::post('/register-claim/send-email',[RegisterClaimController::class,'send_email'])->name('register-claim.send-email');
    Route::post('/register-claim',[RegisterClaimController::class,'store'])->name('register-claim.create');
    Route::put('/register-claim/edit/{id}',[RegisterClaimController::class,'update'])->name('register-claim.update');
    Route::post('/register-claim/schedule',[RegisterClaimController::class,'updateSchedule'])->name('register-claim.schedule');
    Route::post('/register-claim/report',[RegisterClaimController::class,'reportSchedule'])->name('register-claim.report');
    Route::post('/register-claim/ajax',[RegisterClaimController::class,'ajaxUploadVideo'])->name('register-claim.ajaxUploadVideo');
    Route::post('/register-claim/delete',[RegisterClaimController::class,'deleteClaim'])->name('register-claim.deleteClaim');
    Route::post('/register-claim/detail',[RegisterClaimController::class, 'detailClaim'])->name('register-claim.details');
    Route::get('/register-claim/export_excel/{id}', [RegisterClaimController::class, 'export_excel']);
    Route::post('/register-claim/export_excel/report', [RegisterClaimController::class, 'export_excel_claim_summary_report'])->name('register-claim.export_excel_claim_summary_report');
    Route::post('/register-claim/export_excel', [RegisterClaimController::class, 'export_excel_claim_summary'])->name('register-claim.export_excel_claim_summary');
    Route::get('/register-claim/export_pdf/{id}', [RegisterClaimController::class, 'export_pdf']);

    // users
    Route::get('/users',[UsersController::class,'index'])->name('users');
    Route::put('/users/edit/{id}',[UsersController::class,'update'])->name('users.update');
    Route::put('/users/reset/{id}',[UsersController::class,'resetPassword'])->name('users.reset');
    Route::put('/users/approve/{id}',[UsersController::class,'approve'])->name('users.approve');
    Route::post('/users/delete/{id}',[UsersController::class,'destroy'])->name('users.delete');
    Route::post('/users/create',[UsersController::class,'store'])->name('users.create');

    // team
    Route::get('/team',[TeamController::class,'index'])->name('team');
    Route::post('/team/create',[TeamController::class,'store'])->name('team.create');
    Route::put('/team/edit/{id}',[TeamController::class,'update'])->name('team.update');
    Route::post('/team/delete/{id}',[TeamController::class,'destroy'])->name('team.delete');

    // branch
    Route::get('/branch',[BranchController::class,'index'])->name('branch');
    Route::post('/branch/create',[BranchController::class,'store'])->name('branch.create');
    Route::put('/branch/edit/{id}',[BranchController::class,'update'])->name('branch.update');
    Route::post('/branch/delete/{id}',[BranchController::class,'destroy'])->name('branch.delete');

    // part
    Route::get('/part',[PartController::class,'index'])->name('part');
    Route::post('/part/delete/{id}',[PartController::class,'destroy'])->name('part.delete');
    Route::put('/part/edit/{id}',[PartController::class,'update'])->name('part.update');
    Route::post('/part/create',[PartController::class,'store'])->name('part.create');

    // type part
    Route::get('/typepart',[TypePartController::class,'index'])->name('typepart');
    Route::post('/typepart/delete/{id}',[TypePartController::class,'destroy'])->name('typepart.delete');
    Route::put('/typepart/edit/{id}',[TypePartController::class,'update'])->name('typepart.update');
    Route::post('/typepart/create',[TypePartController::class,'store'])->name('typepart.create');

    // vehicle
    Route::get('/vehicle',[VehicleController::class,'index'])->name('vehicle');
    Route::post('/vehicle/delete/{id}',[VehicleController::class,'destroy'])->name('vehicle.delete');
    Route::put('/vehicle/edit/{id}',[VehicleController::class,'update'])->name('vehicle.update');
    Route::post('/vehicle/create',[VehicleController::class,'store'])->name('vehicle.create');
});



Route::group(['middleware' => ['auth']], function () { 
    Route::get('/',[DashboardController::class,'index'])->name('main-dashboard');
});

Auth::routes();

// untuk select2 autocomplete branch,role,vehcile
Route::get('/branch/query/autocomplete',[BranchController::class,'autocomplete'])->name('branch.autocomplete');
Route::get('/role/query/autocomplete',[BranchController::class,'autocompleteRole'])->name('role.autocompleteRole');
Route::get('/vehicle/query/autocomplete',[VehicleController::class,'autocomplete'])->name('vehicle.autocomplete');
Route::get('/meetSchedule/query',[RegisterSurveyController::class,'meetSchedule'])->name('meetSchedule.json');

Route::get('/test_query',[RegisterSurveyController::class,'test_query'])->name('test_query');

// untuk filter register date
Route::get('/filterRegisterDate/query',[RegisterSurveyController::class,'filterRegisterDate'])->name('filterRegisterDate.datatable');

// untuk tampilan register and forgot password success
Route::get('/password/success',[ResetPasswordController::class,'success'])->name('reset.success');
Route::get('/register/success',[RegisterController::class,'success'])->name('register.success');

// webhook untuk autodeploy
Route::get('/deploy',[AutoDeployController::class,'deploy'])->name('deploy');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// github webhook untuk trigger deployment
Route::githubWebhooks('deploy-webhook');