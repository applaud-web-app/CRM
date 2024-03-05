<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;

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

Route::get('/login',[AuthController::class,'checkLogin'])->name('login');

// Add Permission
Route::get('/add/permission',[PermissionController::class,'addPermission'])->name('add.permission');
Route::post('/add/permission',[PermissionController::class,'storePermission'])->name('store.permission');
Route::get('/edit/permission/{id}',[PermissionController::class,'editPermission'])->name('edit.permission');
Route::post('/edit/permission/{id}',[PermissionController::class,'updatePermission'])->name('update.permission');
Route::get('/delete/permission/{id}',[PermissionController::class,'deletePermission'])->name('delete.permission');
Route::get('/view/permission',[PermissionController::class,'viewPermission'])->name('view.permission');

// Add Role 
Route::get('/add/role',[RoleController::class,'addRole'])->name('add.role');
Route::post('/add/role',[RoleController::class,'storeRole'])->name('store.role');
Route::get('/edit/role/{id}',[RoleController::class,'editRole'])->name('edit.role');
Route::post('/edit/role/{id}',[RoleController::class,'updateRole'])->name('update.role');
Route::get('/delete/role/{id}',[RoleController::class,'deleteRole'])->name('delete.role');
Route::get('/view/role',[RoleController::class,'viewRole'])->name('view.role');

// Assign Role
Route::get('assign/permission',[RoleController::class,'assignPermission'])->name('role.permission');
Route::post('assign/permission',[RoleController::class,'storeAssignPermission'])->name('role.storePermission');


Route::get('/', function () {
    return view('dashboard');
});
