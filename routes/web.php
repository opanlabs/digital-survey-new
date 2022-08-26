<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterSurveyController;
use App\Http\Controllers\PartController;
use App\Http\Controllers\TypePartController;
use App\Http\Controllers\VehicleController;

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

Route::group(['prefix' => 'dashboard', 'middleware' => ['auth']], function(){
    Route::get('/main',[DashboardController::class,'index'])->name('dashboard');
    Route::get('/profile',[ProfileController::class,'index'])->name('profile');
    Route::put('/profile/edit/{id}',[ProfileController::class,'update'])->name('profile.edit');
    Route::get('/register-survey',[RegisterSurveyController::class,'index'])->name('register-survey');
    Route::post('/register-survey',[RegisterSurveyController::class,'store'])->name('register-survey.create');
    Route::get('/users',[UsersController::class,'index'])->name('users');
    Route::get('/branch',[BranchController::class,'index'])->name('branch');
    Route::get('/part',[PartController::class,'index'])->name('part');
    Route::get('/typepart',[TypePartController::class,'index'])->name('typepart');
    Route::get('/vehicle',[VehicleController::class,'index'])->name('vehicle');
});



Route::group(['middleware' => ['auth']], function () { 
    Route::get('/',[DashboardController::class,'index'])->name('main-dashboard');
});

Auth::routes();

//untuk select2 autocomplete branch
Route::get('/branch/query/autocomplete',[BranchController::class,'autocomplete'])->name('branch.autocomplete');
Route::get('/role/query/autocomplete',[BranchController::class,'autocompleteRole'])->name('role.autocompleteRole');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
