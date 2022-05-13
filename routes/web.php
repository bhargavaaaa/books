<?php

// use App\Http\Controllers\Admin\PublicationController;
// use App\Http\Controllers\Admin\BoardController;
// use App\Http\Controllers\Admin\ProductController;
// use App\Http\Controllers\Admin\CategoryController;
// use App\Http\Controllers\Admin\CMSPageController;
// use App\Http\Controllers\Admin\ContactUsController;
// use App\Http\Controllers\Admin\OrdersController;
// use App\Http\Controllers\Admin\StandardController;
// use App\Http\Controllers\Admin\SchoolController;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CMSPageController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\HomeBanner;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\ReturnController;
use App\Http\Controllers\Admin\StandardController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\SchoolController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
|
*/

Route::get('/clear-cache', function () {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return redirect('admin/home');
});

// Route::get('/', function () {
//     // return redirect()->route('login');
//     Route::get('home', [MainController::class, 'home'])
//     return view('welcome');
// })->name('site.home');


Route::view('/cart','front.cart');
Route::view('/checkout','front.checkout');
Route::view('/compare','front.compare');
// Route::view('/contact-2','front.contact-2');
Route::view('/contact','front.contact')->name('contactUs');
Route::view('/login-register','front.login-register')->name('front.login-register');
Route::view('/my-account','front.my-account');
Route::view('/faq','front.faq');
Route::view('/order-details','front.order-details');
Route::view('/product-details','front.product-details');
Route::view('/product-details-affiliate','front.product-details-affiliate');
Route::view('/shop-grid','front.shop-grid');
Route::view('/wishlist','front.wishlist');
Route::view('/shop-list','front.shop-list');


Route::group(['prefix' => '/'], function () {
    // Route::get('/', function () {return view('welcome');})->name('site.home');
    Route::get('/', [MainController::class, 'home'])->name('site.home');

    Route::get('/product',[ProductController::class,'index'])->name('front.product');
    Route::get('/product_detail/{id}',[ProductController::class,'product_detail'])->name('product_detail');
    Route::post('/relatedproduct_detail',[ProductController::class,'relatedproduct_detail'])->name('relatedproduct_detail');

    Route::post('/load_products',[ProductController::class,'load_products'])->name('load_products');
    Route::view('/product-details','front.product-details');
});




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
        Route::get('/', [App\Http\Controllers\Admin\BoardController::class, 'index'])->name('board.index')->middleware("permission:view.board");
        Route::get('/getBoardData', [App\Http\Controllers\Admin\BoardController::class, 'getBoardData'])->name('board.getBoardData')->middleware("permission:view.board");
        Route::get('/create', [App\Http\Controllers\Admin\BoardController::class, 'create'])->name('board.create')->middleware("permission:create.board");
        Route::post('/store', [App\Http\Controllers\Admin\BoardController::class, 'store'])->name('board.store')->middleware("permission:create.board");
        Route::get('/edit/{id}', [App\Http\Controllers\Admin\BoardController::class, 'edit'])->name('board.edit')->middleware("permission:edit.board");
        Route::put('/{id}', [App\Http\Controllers\Admin\BoardController::class, 'update'])->name('board.update')->middleware("permission:edit.board");
        Route::get('/delete/{id}', [App\Http\Controllers\Admin\BoardController::class, 'delete'])->name('board.delete')->middleware("permission:delete.board");
        Route::post('/checkBoardName', [App\Http\Controllers\Admin\BoardController::class, 'checkBoardName'])->name('board.checkBoardName');
        Route::get('/boardActiveInactive/{id}', [App\Http\Controllers\Admin\BoardController::class, 'boardActiveInactive'])->name('board.activeInactive')->middleware("permission:activeinactive.board");
    });

    /** Routes For Publication */
    Route::prefix('publication')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\PublicationController::class, 'index'])->name('publication.index')->middleware("permission:view.publications");
        Route::get('/getData', [App\Http\Controllers\Admin\PublicationController::class, 'getData'])->name('publication.getData')->middleware("permission:view.publications");
        Route::get('/create', [App\Http\Controllers\Admin\PublicationController::class, 'create'])->name('publication.create')->middleware("permission:create.publications");
        Route::post('/store', [App\Http\Controllers\Admin\PublicationController::class, 'store'])->name('publication.store')->middleware("permission:create.publications");
        Route::get('/edit/{id}', [App\Http\Controllers\Admin\PublicationController::class, 'edit'])->name('publication.edit')->middleware("permission:edit.publications");
        Route::post('/update/{id}', [App\Http\Controllers\Admin\PublicationController::class, 'update'])->name('publication.update')->middleware("permission:edit.publications");
        Route::post('/delete', [App\Http\Controllers\Admin\PublicationController::class, 'delete'])->name('publication.delete')->middleware("permission:delete.publications");
        Route::get('/ActiveInactive/{id}', [App\Http\Controllers\Admin\PublicationController::class, 'ActiveInactive'])->name('publication.activeInactive')->middleware("permission:activeinactive.publications");
    });

    Route::prefix('school')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\SchoolController::class, 'index'])->name('school.index')->middleware("permission:view.schools");
        Route::get('/getData', [App\Http\Controllers\Admin\SchoolController::class, 'getData'])->name('school.getData')->middleware("permission:view.schools");
        Route::get('/create', [App\Http\Controllers\Admin\SchoolController::class, 'create'])->name('school.create')->middleware("permission:create.schools");
        Route::post('/store', [App\Http\Controllers\Admin\SchoolController::class, 'store'])->name('school.store')->middleware("permission:create.schools");
        Route::get('/edit/{id}', [App\Http\Controllers\Admin\SchoolController::class, 'edit'])->name('school.edit')->middleware("permission:edit.schools");
        Route::post('/update/{id}', [App\Http\Controllers\Admin\SchoolController::class, 'update'])->name('school.update')->middleware("permission:edit.schools");
        Route::post('/delete', [App\Http\Controllers\Admin\SchoolController::class, 'delete'])->name('school.delete')->middleware("permission:delete.schools");
        Route::get('/ActiveInactive/{id}', [App\Http\Controllers\Admin\SchoolController::class, 'ActiveInactive'])->name('school.activeInactive')->middleware("permission:activeinactive.schools");
    });

    Route::prefix('standard')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\StandardController::class, 'index'])->name('standard.index');
        Route::get('/getStandardData', [App\Http\Controllers\Admin\StandardController::class, 'getStandardData'])->name('standard.getStandardData');
        Route::get('/create', [App\Http\Controllers\Admin\StandardController::class, 'create'])->name('standard.create');
        Route::post('/store', [App\Http\Controllers\Admin\StandardController::class, 'store'])->name('standard.store');
        Route::get('/edit/{id}', [App\Http\Controllers\Admin\StandardController::class,'edit'])->name('standard.edit');
        Route::put('/{id}', [App\Http\Controllers\Admin\StandardController::class, 'update'])->name('standard.update');
        Route::get('/delete/{id}',[App\Http\Controllers\Admin\StandardController::class, 'delete'])->name('standard.delete');
        Route::get('/standardActiveInactive/{id}',[App\Http\Controllers\Admin\StandardController::class, 'standardActiveInactive'])->name('standard.activeInactive');
    });

    Route::prefix('product')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\ProductController::class, 'index'])->name('product.index')->middleware("permission:view.products");
        Route::get('/getData', [App\Http\Controllers\Admin\ProductController::class, 'getData'])->name('product.getData')->middleware("permission:view.products");
        Route::get('/create', [App\Http\Controllers\Admin\ProductController::class, 'create'])->name('product.create')->middleware("permission:create.products");
        Route::post('/store', [App\Http\Controllers\Admin\ProductController::class, 'store'])->name('product.store');
        Route::get('/edit/{id}', [App\Http\Controllers\Admin\ProductController::class, 'edit'])->name('product.edit')->middleware("permission:edit.products");
        Route::post('/update/{id}', [App\Http\Controllers\Admin\ProductController::class, 'update'])->name('product.update');
        Route::post('/delete', [App\Http\Controllers\Admin\ProductController::class, 'delete'])->name('product.delete')->middleware("permission:delete.products");
        Route::post('/checkName', [App\Http\Controllers\Admin\ProductController::class, 'checkName'])->name('product.checkName');
        Route::get('/ActiveInactive/{id}', [App\Http\Controllers\Admin\ProductController::class, 'ActiveInactive'])->name('product.activeInactive')->middleware("permission:activeinactive.products");
    });

    Route::prefix('orders')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\OrdersController::class, 'index'])->name('orders.index')->middleware("permission:view.orders");
        Route::post('getReceivedOrdersData', [App\Http\Controllers\Admin\OrdersController::class, 'getReceivedOrdersData'])->name('orders.getReceivedOrdersData')->middleware("permission:view.orders");
        Route::post('getShippedOrdersData', [App\Http\Controllers\Admin\OrdersController::class, 'getShippedOrdersData'])->name('orders.getShippedOrdersData')->middleware("permission:view.orders");
        Route::post('getDeliveredOrdersData', [App\Http\Controllers\Admin\OrdersController::class, 'getDeliveredOrdersData'])->name('orders.getDeliveredOrdersData')->middleware("permission:view.orders");
        Route::post('getCancelledOrdersData', [App\Http\Controllers\Admin\OrdersController::class, 'getCancelledOrdersData'])->name('orders.getCancelledOrdersData')->middleware("permission:view.orders");
        Route::post('getRejectedOrdersData', [App\Http\Controllers\Admin\OrdersController::class, 'getRejectedOrdersData'])->name('orders.getRejectedOrdersData')->middleware("permission:view.orders");
        Route::get('show/{id}', [App\Http\Controllers\Admin\OrdersController::class, 'show'])->name('orders.show')->middleware("permission:view.orders");
        Route::post('state/change', [App\Http\Controllers\Admin\OrdersController::class, 'stateChange'])->name('orders.state.change')->middleware("permission:edit.orders");
    });

    Route::prefix('return-orders')->group(function () {
        Route::get('/', [ReturnController::class, 'index'])->name('return.orders.index')->middleware("permission:view.returnorders");
        Route::post('getRequestRegisteredData', [ReturnController::class, 'getRequestRegisteredData'])->name('return.orders.getRequestRegisteredData')->middleware("permission:view.returnorders");
        Route::post('getRequestAcceptedData', [ReturnController::class, 'getRequestAcceptedData'])->name('return.orders.getRequestAcceptedData')->middleware("permission:view.returnorders");
        Route::post('getRequestRejectedData', [ReturnController::class, 'getRequestRejectedData'])->name('return.orders.getRequestRejectedData')->middleware("permission:view.returnorders");
        Route::post('getReturnTakenData', [ReturnController::class, 'getReturnTakenData'])->name('return.orders.getReturnTakenData')->middleware("permission:view.returnorders");
        Route::post('getReturnAcceptedData', [ReturnController::class, 'getReturnAcceptedData'])->name('return.orders.getReturnAcceptedData')->middleware("permission:view.returnorders");
        Route::post('getReturnRejectedData', [ReturnController::class, 'getReturnRejectedData'])->name('return.orders.getReturnRejectedData')->middleware("permission:view.returnorders");
        Route::post('getCashbackGivenData', [ReturnController::class, 'getCashbackGivenData'])->name('return.orders.getCashbackGivenData')->middleware("permission:view.returnorders");
        Route::post('getReplacementGivenData', [ReturnController::class, 'getReplacementGivenData'])->name('return.orders.getReplacementGivenData')->middleware("permission:view.returnorders");
        Route::post('state/change', [ReturnController::class, 'stateChange'])->name('return.orders.state.change')->middleware('permission:create.returnorders');
    });

    Route::group(['prefix' => 'category'], function(){
        Route::get('/', [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('category.index')->middleware("permission:view.category");
        Route::get('/getCategoryData', [App\Http\Controllers\Admin\CategoryController::class, 'getCategoryData'])->name('category.getCategoryData')->middleware("permission:view.category");
        Route::get('/create', [App\Http\Controllers\Admin\CategoryController::class, 'create'])->name('category.create')->middleware("permission:create.category");
        Route::post('/store', [App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('category.store')->middleware("permission:create.category");
        Route::get('/edit/{id}', [App\Http\Controllers\Admin\CategoryController::class,'edit'])->name('category.edit')->middleware("permission:edit.category");
        Route::put('/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'update'])->name('category.update')->middleware("permission:edit.category");
        Route::get('/delete/{id}',[App\Http\Controllers\Admin\CategoryController::class, 'delete'])->name('category.delete')->middleware("permission:delete.category");
        Route::post('/checkName',[App\Http\Controllers\Admin\CategoryController::class, 'checkName'])->name('category.checkName');
        Route::get('/categoryActiveInactive/{id}',[App\Http\Controllers\Admin\CategoryController::class, 'categoryActiveInactive'])->name('category.activeInactive')->middleware("permission:activeinactive.category");
    });

    /* Routes For ContactUs */
    Route::get('contact_us',[App\Http\Controllers\Admin\ContactUsController::class, 'index'])->name('contact_us.index');
    Route::get('/getContactUsData',[App\Http\Controllers\Admin\ContactUsController::class, 'getContactUsData'])->name('contact_us.getContactUsData');

    /* Routes Fro CMS Pages */
    Route::group(['prefix' => 'cms_page'], function() {
        Route::get('/', [App\Http\Controllers\Admin\CMSPageController::class, 'index'])->name('cms_page.index');
        Route::get('/getCmsPageData', [App\Http\Controllers\Admin\CMSPageController::class, 'getCmsPageData'])->name('cms_page.getCmsPageData');
        Route::get('/create', [App\Http\Controllers\Admin\CMSPageController::class, 'create'])->name('cms_page.create');
        Route::post('/store', [App\Http\Controllers\Admin\CMSPageController::class, 'store'])->name('cms_page.store');
        Route::get('/edit/{id}', [App\Http\Controllers\Admin\CMSPageController::class, 'edit'])->name('cms_page.edit');
        Route::put('/{id}', [App\Http\Controllers\Admin\CMSPageController::class, 'update'])->name('cms_page.update');
        Route::get('/delete/{id}', [App\Http\Controllers\Admin\CMSPageController::class, 'delete'])->name('cms_page.delete');
    });

    Route::prefix('banner')->group(function () {
        Route::get('/',[HomeBanner::class, 'index'])->name('banner.index');
        Route::get('/getBannerData',[HomeBanner::class, 'getBannerData'])->name('banner.getBannerData');
        Route::get('/create', [HomeBanner::class, 'create'])->name('banner.create');
        Route::post('/store', [HomeBanner::class, 'store'])->name('banner.store');
        Route::get('/view/{id}', [HomeBanner::class, 'view'])->name('banner.view');
        Route::get('/delete/{id}', [HomeBanner::class, 'delete'])->name('banner.delete');
        Route::get('/activeInactive/{id}',[HomeBanner::class, 'activeInactive'])->name('banner.activeInactive');
    });
});
