<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/clear-cache', function () {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return redirect('admin/home');
});

Route::get('/', function () {
    return redirect()->route('login');
})->name('site.home');



Route::group(['prefix' => 'admin'], function () {
    Route::get('register', function () {
        return redirect()->route('login');
    });
    Auth::routes();
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/', function () {
        return redirect()->route('admin.home');
    });
    Route::get('home', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin.home');

    /** Routes For ChangePassword */
    Route::get('changePassword', [App\Http\Controllers\Admin\ChangePasswordController::class,'index'])->name('admin.changePassword');
    Route::post('checkOldPassword', [App\Http\Controllers\Admin\ChangePasswordController::class,'checkOldPassword'])->name('admin.checkoldpassword');
    Route::post('updateUserPassword', [App\Http\Controllers\Admin\ChangePasswordController::class,'updateUserPassword'])->name('admin.updatepassword');

    /** Routes For Role */
    Route::get('role', [App\Http\Controllers\Admin\RoleController::class,'index'])->name('role.index');
    Route::get('getRoleData', [App\Http\Controllers\Admin\RoleController::class,'getRoleData'])->name('role.getRoleData');
    Route::get('role/create', [App\Http\Controllers\Admin\RoleController::class,'create'])->name('role.create');
    Route::post('role/store', [App\Http\Controllers\Admin\RoleController::class,'store'])->name('role.store');
    Route::post('checkRoleName', [App\Http\Controllers\Admin\RoleController::class,'checkRoleName'])->name('role.checkRoleName');
    Route::get('role/edit/{id}', [App\Http\Controllers\Admin\RoleController::class,'edit'])->name('role.edit');
    Route::put('role/{id}', [App\Http\Controllers\Admin\RoleController::class,'update'])->name('role.update');
    Route::post('role/delete', [App\Http\Controllers\Admin\RoleController::class,'delete'])->name('role.delete');

    /** Routes For Users */
    Route::get('users', [App\Http\Controllers\Admin\UserController::class,'index'])->name('users.index');
    Route::get('getUserData', [App\Http\Controllers\Admin\UserController::class,'getUserData'])->name('users.getUserData');
    Route::get('users/create', [App\Http\Controllers\Admin\UserController::class,'create'])->name('users.create');
    Route::post('users/store', [App\Http\Controllers\Admin\UserController::class,'store'])->name('users.store');
    Route::post('checkUserEmail', [App\Http\Controllers\Admin\UserController::class,'checkUserEmail'])->name('users.checkUserEmail');
    Route::get('users/edit/{id}', [App\Http\Controllers\Admin\UserController::class,'edit'])->name('users.edit');
    Route::put('users/{id}', [App\Http\Controllers\Admin\UserController::class,'update'])->name('users.update');
    Route::post('users/delete', [App\Http\Controllers\Admin\UserController::class,'delete'])->name('users.delete');
    Route::get('userActiveInactive/{type}/{id}',[App\Http\Controllers\Admin\UserController::class,'userActiveInactive'])->name('users.activeInactive');
    Route::get('userApproveDisapprove/{type}/{id}',[App\Http\Controllers\Admin\UserController::class,'userApproveDisapprove'])->name('users.approveDisapprove');
});