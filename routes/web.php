<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ApplicantsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\SettingsController;

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
    Route::post('/account-setting',[UserController::class,'updateAccountSetting'])->name('accountSetting');
    Route::get('/update-password',[UserController::class,'userpassword'])->name('userpassword');
    Route::post('/update-password',[UserController::class,'updateUserpassword'])->name('updateUserpassword');

    // EXCEL UPLOADS

    // Settings Route
    Route::get('/generalsetting',[SettingsController::class,'loadgeneralsettings'])->name('generalsetting');
    Route::post('/generalupdate',[SettingsController::class,'updategeneralsetting'])->name('generalupdate');
    Route::get('/ratings',[SettingsController::class,'loadratings'])->name('ratings');
    Route::post('/saveratings',[SettingsController::class,'updateratings'])->name('saveratings');
    Route::get('/emailsetting',[SettingsController::class,'loadEmailSettings'])->name('emailsetting');
    Route::get('/passwordsetting',[SettingsController::class,'loadPasswordSetting'])->name('passwordsetting');
    Route::get('/apisetting',[SettingsController::class,'loadApiSettting'])->name('apisetting');
    Route::post('/update_email_setting',[SettingsController::class,'updateEmailSetting'])->name('update_email_setting');
    Route::post('/updategoogleapi',[SettingsController::class,'updateGoogleApi'])->name('updategoogleapi');
    Route::post('/updatefbapi',[SettingsController::class,'updateFbApi'])->name('updatefbapi');
    Route::post('/updatejustdialapi',[SettingsController::class,'updateJdApi'])->name('updatejustdialapi');
    Route::post('/updateinstagramapi',[SettingsController::class,'updateInstagramApi'])->name('updateinstagramapi');
    Route::get('/documents',[SettingsController::class,'DocumentSetting'])->name('documents');
    Route::post('/adddocuments',[SettingsController::class,'addDocuments'])->name('adddocuments');
    // ROLE
    Route::get('/roles',[RoleController::class,'viewRoles'])->name('viewRoles');
    Route::post('/roles',[RoleController::class,'updateRole'])->name('updateRole');

    // EMPLOYEE
    Route::get('/view-employee',[EmployeeController::class,'viewEmployee'])->name('viewEmployee');
    Route::get('/add-employee',[EmployeeController::class,'addEmployee'])->name('addEmployee');
    Route::post('/postaddemployee',[EmployeeController::class,'postAddEmployee'])->name('postaddemployee');
    Route::get('editemployees/{id}',[EmployeeController::class,'editEmployees'])->name('editemployees' );
    Route::get('deleteemployees/{id}',[EmployeeController::class,'deleteEployees'])->name('deleteemployees');
    Route::post('/posteditemployee/{id}',[EmployeeController::class,'updateEmployeeData'])->name('posteditemployee');
        

    // ENQUIRY
    Route::get('/enquiry',[EnquiryController::class,'loadenquiry'])->name('enquiry');
    Route::post('/newenquiry',[EnquiryController::class,'saveenquiry'])->name('newenquiry');
    Route::post('/editenquiry',[EnquiryController::class,'editenquiry'])->name('editenquiry');
    Route::get('/deleteenquiry/{id}',[EnquiryController::class,'deleteenquiry'])->name('deleteenquiry');
    Route::post('/enquiry/bulk-uploads',[EnquiryController::class,'bulkUploadEnquiry'])->name('bulkUploadEnquiry');
    Route::get('/convertenquiry/{id}',[EnquiryController::class,'convertToLead'])->name('convertenquiry');
    Route::post('/leadgenerate/{id}',[EnquiryController::class,'leadGenerate'])->name('leadgenerate');
    Route::get('/leads',[EnquiryController::class,'loadLeads'])->name('leads');
    Route::get('/leaddelete/{id}',[EnquiryController::class,'leadDelete'])->name('leaddelete');
    Route::get('/createlead',[EnquiryController::class,'loadCreateLead'])->name('createlead');
    Route::post('/updateleadtype/{id}',[EnquiryController::class,'updateLeadType'])->name('updateleadtype');
    Route::post('/updatestatustype/{id}',[EnquiryController::class,'updateStatusType'])->name('updatestatustype');
    Route::post('/newleadcreate',[EnquiryController::class,'createNewLead'])->name('newleadcreate');
    Route::get('/editaddedlead/{id}',[EnquiryController::class,'editNewAddedLead'])->name('editaddedlead');
    Route::post('/updatelead/{id}',[EnquiryController::class,'updateLeadData'])->name('updatelead');
    Route::post('/loadstates',[EnquiryController::class,'loadStateData'])->name('loadstates');
    Route::post('/loadcities',[EnquiryController::class,'loadCities'])->name('loadcities');
    Route::post('/loadimmigrationtype',[EnquiryController::class,'loadImmigrationType'])->name('loadimmigrationtype');
    Route::get('/applyapproval/{id}',[EnquiryController::class,'applyApproval'])->name('applyapproval');
    Route::get('/viewLeaddata/{id}',[EnquiryController::class,'viewLeadData'])->name('viewLeaddata');
    Route::get('/addleaddocument/{id}',[EnquiryController::class,'addLeadDocument'])->name('addleaddocument');
    Route::post('/postadddocuments/{id}',[EnquiryController::class,'postAddDocuments'])->name('postadddocuments');
    Route::get('/deletedocs/{id}/{id2}',[EnquiryController::class,'deleteDocs'])->name('deletedocs');
    Route::get('/followup/{id}',[EnquiryController::class,'followUp'])->name('followup');
    Route::post('/createfollowup/{id}',[EnquiryController::class,'createFollowUp'])->name('createfollowup');
    Route::get('/deletefollowup/{id}',[EnquiryController::class,'deleteFollowUp'])->name('deletefollowup');
    Route::post('/editfollowup',[EnquiryController::class,'editFollowUp'])->name('editfollowup');
    
    //Activities
    Route::get('/activities',[ActivityController::class,'getActivities'])->name('activities');

    //Applicants
    Route::get( '/pendingapplicants',[ApplicantsController::class,'pendingApplicants'])->name('pendingapplicants');
    Route::get('/viewapplicant/{id}',[ApplicantsController::class,'viewApplicantData'])->name('viewapplicant');
    Route::get('/rejectapproval/{id}',[ApplicantsController::class,'rejectApproval'])->name('rejectapproval');
    Route::get('/approved/{id}',[ApplicantsController::class,'approvedRequest'])->name('approved');
    Route::get('/allapplicants',[ApplicantsController::class,'allApplicants'])->name('allapplicants');
    Route::get('/addnewapplicant',[ApplicantsController::class,'addNewApplicant'])->name('addnewapplicant');
    Route::get('/applicantdata/{id}',[ApplicantsController::class,'applicantDetails'])->name('applicantdata');
    Route::post('/postaddapplicant',[ApplicantsController::class,'postAddApplicant'])->name('postaddapplicant');
});

