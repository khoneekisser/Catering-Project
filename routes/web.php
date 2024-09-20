<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AddMenuController;
use App\Http\Controllers\OrderController;


//for the owner signup page
Route::get('/owner-sign-up', function () {
    return view('OwnerSignup');
})->name('owner-sign-up')->middleware('alreadyLoggedIn');

Route::get('/googe-map', function () {
    return view('gogle-map');
});

//for customer sign-up
Route::get('/customer-sign-up', function () {
    return view('CustomerSignup');
})->name('customer-sign-up')->middleware('alreadyLoggedIn');



//owner signup post
Route::POST('/ownerdatasubmit',[RegistrationController::class,
    'ownerdatasubmit'])->name('ownerdatasubmit');

// for updating the owner Information
Route::POST('/ownerRecordUpdate',[RegistrationController::class,
    'ownerRecordUpdate'])->name('ownerRecordUpdate');

// for updating the customer Information
Route::POST('/customerRecordUpdate',[CustomerController::class,
    'customerRecordUpdate'])->name('customerRecordUpdate');

//customer signup post
Route::POST('/customerDataSubmit',[CustomerController::class,
    'customerDataSubmit'])->name('customerDataSubmit');


//for the dashboard
Route::get('/main-dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware('diabale_back_btn');



//for owner and customer login page
Route::get('/', function () {
    return view('login');
})->name('loginPage')->middleware('alreadyLoggedIn');

//for  admin login page
Route::get('/admin-login', function () {
    return view('adminLogin');
})->name('admin-login')->middleware('diabale_back_btn');;

//for user/customer login into dashboard
Route::post('/login-user', [LoginController::class, 'Login'])->name('login');

//for customer dashboard function
Route::get('customer',[LoginController::class, 'customer'])->middleware('diabale_back_btn');;

//for owner dashboard function
Route::get('owner',[LoginController::class, 'owner'])->middleware('diabale_back_btn');;

//for admin login
Route::post('/adminLogin', [LoginController::class, 'AdminLogin'])->name('adminLogin');
//admin showing information
Route::get('/dashboard',[LoginController::class, 'dashboard'])->middleware('diabale_back_btn');;

//for testing
Route::get('/map', function () {
    return view('example');
});

//for changing the status  of the owners 
Route::post('/toggle-active/{id}', [LoginController::class, 'toggleActive']);

//for adding the new branch
Route::POST('/store-data/{data}',[RegistrationController::class,'store'])
    ->name('storeData');

//for adding new menu data
Route::POST('/add-menu/{id}',[AddMenuController::class,'addMenu'])
    ->name('addMenu');

//for adding new qr data by owner
Route::POST('/add-qr/{id}',[AddMenuController::class,'addQR'])
    ->name('addQR');

//for editing menu by admin of owner
Route::POST('/admin-edit-menu',[AddMenuController::class,'adminEditMenu'])
    ->name('adminEditMenu');

//for updating order data by admin
Route::POST('/add-update-order',[OrderController::class,'adminUpdateOrders'])
    ->name('adminUpdateOrders');


// for updating the owner Information
Route::POST('/adminAddMenu',[AddMenuController::class,
    'adminAddMenu'])->name('adminAddMenu');

//for edit menu data
Route::PUT('/edit-menu-data',[AddMenuController::class,'editMenu'])
    ->name('editMenuData');

//for deleting the menu data
Route::get('/delete/{id}',[AddMenuController::class,'delete'])
    ->name('deleteData');

//for adding new order data
Route::POST('/add-order',[OrderController::class,'addOrder'])
    ->name('addOrder');

//for canceling the order
Route::get('/cancelOrder/{id}',[OrderController::class,'cancelOrder'])
    ->name('cancelOrder');

//for deleting the order
Route::get('/deleteOrder/{id}',[OrderController::class,'deleteOrder'])
    ->name('deleteOrder');

//for completion of order
Route::get('/orderComplete/{id}',[OrderController::class,'orderComplete'])
    ->name('orderComplete');

// for the logout of admin
Route::get('/adminLogout', [LoginController::class, 'adminLogout'])
    ->name('logout-admin');

//for updating owners password
Route::POST('/password-update-owner',[LoginController::class,'updatePassword'])
    ->name('updateOwnerPassword');

//for feedback to the owner  by the customer
Route::POST('/feed-back',[AddMenuController::class,'customerFeedback'])
->name('customerFeedback');

//for adding new pp of customer
Route::POST('/add-pp/{id}',[AddMenuController::class,'addPP'])
    ->name('addPP');

//for feedback update by admin of customer to owner
Route::POST('/feed-back-update',[AddMenuController::class,'customerFeedbackUpdate'])
->name('customerFeedbackUpdate');

//for feedback to the owner  by the customer
Route::POST('/report-admin',[AddMenuController::class,'userReportSubmit'])
->name('userReportSubmit');