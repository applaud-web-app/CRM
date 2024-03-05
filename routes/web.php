<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login',[AuthController::class,'login'])->name('login');
Route::post('/login',[AuthController::class,'checkLogin'])->name('login');
Route::get('/forget-password',[AuthController::class,'forgetPassword'])->name('forgetPassword');
Route::post('/forget-password',[AuthController::class,'postforgetPassword'])->name('forgetPassword');

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () { return view('dashboard'); })->name('dashboard');
    Route::get('/', function () { return view('dashboard'); })->name('dashboard');
    Route::get('/logout',[AuthController::class,'logout'])->name('logout');
    Route::get('/account-setting',[UserController::class,'accountSetting'])->name('accountSetting');
    Route::get('/update-password',[UserController::class,'updateUserpassword'])->name('updateUserpassword');

    // Settings Route
    Route::get('/generalsetting',[SettingsController::class,'loadgeneralsettings'])->name('generalsetting');
    Route::post('/generalupdate',[SettingsController::class,'updategeneralsetting'])->name('generalupdate');
    Route::get('/ratings',[SettingsController::class,'loadratings'])->name('ratings');
    Route::post('/saveratings',[SettingsController::class,'updateratings'])->name('saveratings');
    Route::get('/emailsetting',[SettingsController::class,'loademailsettings'])->name('emailsetting');
    Route::get('/accountsetting',[SettingsController::class,'loadaccountsetting'])->name('accountsetting');
    Route::get('/passwordsetting',[SettingsController::class,'loadpasswordsetting'])->name('passwordsetting');
    Route::get('/apisetting',[SettingsController::class,'loadapisettting'])->name('apisetting');

});

