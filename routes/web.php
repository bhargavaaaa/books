<?php

use App\Http\Controllers\PublicationController;
use App\Http\Controllers\Admin\BoardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\SchoolController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
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
    Route::get('changePassword', [App\Http\Controllers\Admin\ChangePasswordController::class, 'index'])->name('admin.changePassword');
    Route::post('checkOldPassword', [App\Http\Controllers\Admin\ChangePasswordController::class, 'checkOldPassword'])->name('admin.checkoldpassword');
    Route::post('updateUserPassword', [App\Http\Controllers\Admin\ChangePasswordController::class, 'updateUserPassword'])->name('admin.updatepassword');

    /** Routes For Role */
    Route::get('role', [App\Http\Controllers\Admin\RoleController::class, 'index'])->name('role.index')->middleware("permission:view.roles");
    Route::get('getRoleData', [App\Http\Controllers\Admin\RoleController::class, 'getRoleData'])->name('role.getRoleData')->middleware("permission:view.roles");
    Route::get('role/create', [App\Http\Controllers\Admin\RoleController::class, 'create'])->name('role.create')->middleware("permission:create.roles");
    Route::post('role/store', [App\Http\Controllers\Admin\RoleController::class, 'store'])->name('role.store')->middleware("permission:create.roles");
    Route::post('checkRoleName', [App\Http\Controllers\Admin\RoleController::class, 'checkRoleName'])->name('role.checkRoleName');
    Route::get('role/edit/{id}', [App\Http\Controllers\Admin\RoleController::class, 'edit'])->name('role.edit')->middleware("permission:edit.roles");
    Route::put('role/{id}', [App\Http\Controllers\Admin\RoleController::class, 'update'])->name('role.update')->middleware("permission:edit.roles");
    Route::post('role/delete', [App\Http\Controllers\Admin\RoleController::class, 'delete'])->name('role.delete')->middleware("permission:delete.roles");

    /** Routes For Users */
    Route::get('users', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index')->middleware("permission:view.users");
    Route::get('getUserData', [App\Http\Controllers\Admin\UserController::class, 'getUserData'])->name('users.getUserData')->middleware("permission:view.users");
    Route::get('users/create', [App\Http\Controllers\Admin\UserController::class, 'create'])->name('users.create')->middleware("permission:create.users");
    Route::post('users/store', [App\Http\Controllers\Admin\UserController::class, 'store'])->name('users.store')->middleware("permission:create.users");
    Route::post('checkUserEmail', [App\Http\Controllers\Admin\UserController::class, 'checkUserEmail'])->name('users.checkUserEmail');
    Route::get('users/edit/{id}', [App\Http\Controllers\Admin\UserController::class, 'edit'])->name('users.edit')->middleware("permission:edit.users");
    Route::put('users/{id}', [App\Http\Controllers\Admin\UserController::class, 'update'])->name('users.update')->middleware("permission:edit.users");
    Route::post('users/delete', [App\Http\Controllers\Admin\UserController::class, 'delete'])->name('users.delete')->middleware("permission:delete.users");
    Route::get('userActiveInactive/{type}/{id}', [App\Http\Controllers\Admin\UserController::class, 'userActiveInactive'])->name('users.activeInactive')->middleware("permission:activeinactive.users");
    Route::get('userApproveDisapprove/{type}/{id}', [App\Http\Controllers\Admin\UserController::class, 'userApproveDisapprove'])->name('users.approveDisapprove')->middleware("permission:activeinactive.users");

    /* Route For Board */

    Route::group(['prefix' => 'board'], function () {
        Route::get('/', [BoardController::class, 'index'])->name('board.index')->middleware("permission:view.board");
        Route::get('/getBoardData', [BoardController::class, 'getBoardData'])->name('board.getBoardData')->middleware("permission:view.board");
        Route::get('/create', [BoardController::class, 'create'])->name('board.create')->middleware("permission:create.board");
        Route::post('/store', [BoardController::class, 'store'])->name('board.store')->middleware("permission:create.board");
        Route::get('/edit/{id}', [BoardController::class, 'edit'])->name('board.edit')->middleware("permission:edit.board");
        Route::put('/{id}', [BoardController::class, 'update'])->name('board.update')->middleware("permission:edit.board");
        Route::get('/delete/{id}', [BoardController::class, 'delete'])->name('board.delete')->middleware("permission:delete.board");
        Route::post('/checkBoardName', [BoardController::class, 'checkBoardName'])->name('board.checkBoardName');
        Route::get('/boardActiveInactive/{id}', [BoardController::class, 'boardActiveInactive'])->name('board.activeInactive')->middleware("permission:activeinactive.board");
    });

    /** Routes For Publication */
    Route::prefix('publication')->group(function () {
        Route::get('/', [PublicationController::class, 'index'])->name('publication.index')->middleware("permission:view.publications");
        Route::get('/getData', [PublicationController::class, 'getData'])->name('publication.getData')->middleware("permission:view.publications");
        Route::get('/create', [PublicationController::class, 'create'])->name('publication.create')->middleware("permission:create.publications");
        Route::post('/store', [PublicationController::class, 'store'])->name('publication.store')->middleware("permission:create.publications");
        Route::get('/edit/{id}', [PublicationController::class, 'edit'])->name('publication.edit')->middleware("permission:edit.publications");
        Route::post('/update/{id}', [PublicationController::class, 'update'])->name('publication.update')->middleware("permission:edit.publications");
        Route::post('/delete', [PublicationController::class, 'delete'])->name('publication.delete')->middleware("permission:delete.publications");
        Route::get('/ActiveInactive/{id}', [PublicationController::class, 'ActiveInactive'])->name('publication.activeInactive')->middleware("permission:activeinactive.publications");
    });

    Route::prefix('school')->group(function () {
        Route::get('/', [SchoolController::class, 'index'])->name('school.index')->middleware("permission:view.schools");
        Route::get('/getData', [SchoolController::class, 'getData'])->name('school.getData')->middleware("permission:view.schools");
        Route::get('/create', [SchoolController::class, 'create'])->name('school.create')->middleware("permission:create.schools");
        Route::post('/store', [SchoolController::class, 'store'])->name('school.store')->middleware("permission:create.schools");
        Route::get('/edit/{id}', [SchoolController::class, 'edit'])->name('school.edit')->middleware("permission:edit.schools");
        Route::post('/update/{id}', [SchoolController::class, 'update'])->name('school.update')->middleware("permission:edit.schools");
        Route::post('/delete', [SchoolController::class, 'delete'])->name('school.delete')->middleware("permission:delete.schools");
        Route::get('/ActiveInactive/{id}', [SchoolController::class, 'ActiveInactive'])->name('school.activeInactive')->middleware("permission:activeinactive.schools");
    });

    Route::prefix('product')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('product.index')->middleware("permission:view.products");
        Route::get('/getData', [ProductController::class, 'getData'])->name('product.getData')->middleware("permission:view.products");
        Route::get('/create', [ProductController::class, 'create'])->name('product.create')->middleware("permission:create.products");
        Route::post('/store', [ProductController::class, 'store'])->name('product.store');
        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('product.edit')->middleware("permission:edit.products");
        Route::post('/update/{id}', [ProductController::class, 'update'])->name('product.update');
        Route::post('/delete', [ProductController::class, 'delete'])->name('product.delete')->middleware("permission:delete.products");
        Route::post('/checkName', [ProductController::class, 'checkName'])->name('product.checkName');
        Route::get('/ActiveInactive/{id}', [ProductController::class, 'ActiveInactive'])->name('product.activeInactive')->middleware("permission:activeinactive.products");
    });

    Route::prefix('orders')->group(function () {
        Route::get('/', [OrdersController::class, 'index'])->name('orders.index');
        Route::post('getReceivedOrdersData', [OrdersController::class, 'getReceivedOrdersData'])->name('orders.getReceivedOrdersData');
        Route::post('getShippedOrdersData', [OrdersController::class, 'getShippedOrdersData'])->name('orders.getShippedOrdersData');
        Route::post('getDeliveredOrdersData', [OrdersController::class, 'getDeliveredOrdersData'])->name('orders.getDeliveredOrdersData');
        Route::post('getCancelledOrdersData', [OrdersController::class, 'getCancelledOrdersData'])->name('orders.getCancelledOrdersData');
        Route::post('getRejectedOrdersData', [OrdersController::class, 'getRejectedOrdersData'])->name('orders.getRejectedOrdersData');
        Route::get('show/{id}', [OrdersController::class, 'show'])->name('orders.show');
        Route::post('state/change', [OrdersController::class, 'stateChange'])->name('orders.state.change');
    });

    Route::group(['prefix' => 'category'], function(){
        Route::get('/', [CategoryController::class, 'index'])->name('category.index')->middleware("permission:view.category");
        Route::get('/getCategoryData', [CategoryController::class, 'getCategoryData'])->name('category.getCategoryData')->middleware("permission:view.category");
        Route::get('/create', [CategoryController::class, 'create'])->name('category.create')->middleware("permission:create.category");
        Route::post('/store', [CategoryController::class, 'store'])->name('category.store')->middleware("permission:create.category");
        Route::get('/edit/{id}', [CategoryController::class,'edit'])->name('category.edit')->middleware("permission:edit.category");
        Route::put('/{id}', [CategoryController::class, 'update'])->name('category.update')->middleware("permission:edit.category");
        Route::get('/delete/{id}',[CategoryController::class, 'delete'])->name('category.delete')->middleware("permission:delete.category");
        Route::post('/checkName',[CategoryController::class, 'checkName'])->name('category.checkName');
        Route::get('/categoryActiveInactive/{id}',[CategoryController::class, 'categoryActiveInactive'])->name('category.activeInactive')->middleware("permission:activeinactive.category");
    });
});
