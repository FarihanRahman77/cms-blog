<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\PermissionToRoleController;
use App\Http\Controllers\Admin\UserController;
use Spatie\Permission\Models\Role;
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

Route::get('/', function () {
    return view('auth.loginNew');
})->name('loginNew');



Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('admin.includes.dashboard');
})->name('dashboard');



Route::group(['middleware' => ['auth']], function(){
    /* Banner Route */
    Route::get('banner/view', [BannerController::class, 'index'])->name('bannerView');
    Route::post('banner/store', [BannerController::class, 'store'])->name('bannerStore');
    Route::get('banner/change/status/{id}', [BannerController::class, 'changeStatus'])->name('bannerChangeStatus');
    Route::get('banner/delete/{id}', [BannerController::class, 'destroy'])->name('bannerDelete');
    /*  */

 /* User Route */
 Route::get('user/view',[UserController::class,'index'])->name('userList');
 Route::get('user/create',[UserController::class,'create'])->name('userCreate');
 Route::post('user/store',[UserController::class,'store'])->name('storeUser');
 Route::get('user/edit',[UserController::class,'edit'])->name('editUser');
 Route::post('user/update',[UserController::class,'updateUser'])->name('userUpdate');
 Route::get('user/delete/{id}',[UserController::class,'delete'])->name('userDelete');

 /*  */

 
/* Roles */
Route::get('role/view',[RoleController::class,'index'])->name('rolesList');
Route::get('role/create',[RoleController::class,'create'])->name('roleCreate');
Route::post('role/store',[RoleController::class,'store'])->name('roleStore');
Route::get('role/delete/{id}',[RoleController::class,'destroy'])->name('roleDelete');
/*  */


/* Permissions */
Route::get('permission/view',[PermissionController::class,'index'])->name('permissionList');
Route::post('permission/store',[PermissionController::class,'store'])->name('permissionStore');
Route::get('permission/edit',[PermissionController::class,'edit'])->name('editPermission');
Route::post('permission/update',[PermissionController::class,'update'])->name('permissionUpdate');
Route::get('permission/delete/{id}',[PermissionController::class,'destroy'])->name('permissionDelete');
/*  */

/* Permission to role */ 
Route::get('permission/to/role/view',[PermissionToRoleController::class,'index'])->name('permissionToRoleList');
Route::get('/give/permission',[PermissionToRoleController::class,'givePermission'])->name('givePermission');
Route::post('/give/permission/store',[PermissionToRoleController::class,'store'])->name('roleToPermissionStore');

/*  */

  


   
});



