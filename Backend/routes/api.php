<?php

use App\Http\Controllers\APIAllUserController;
use App\Http\Controllers\ApiCourierController;
use App\Http\Controllers\APICustomerController;
use App\Http\Controllers\ApiManagerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\FlareClient\Api;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//ALL USERS ----------

//GET USER
Route::get('/alluser/get',[APIAllUserController::class,'getUsers'])->middleware("AuthUser");
Route::get('/user/get/{email}',[APIAllUserController::class,'getUser']);

//LOGIN
Route::post('/login',[APIAllUserController::class,'login']);
//LOGOUT
Route::post('/logout',[APIAllUserController::class,'logout']);

//CREATE USER
Route::post('/user/create',[APIAllUserController::class,'createUser']);

//SEND OTP CODE
Route::post('/otp',[APIAllUserController::class,'sendOTP']);
Route::post('/otp/verify',[APIAllUserController::class,'OTPVerify']);
Route::post('/otp/clear',[APIAllUserController::class,'ClearOTP']);
Route::post('/change/password',[APIAllUserController::class,'ChangePassword']);


//courier---Tahmid
Route::get('/courier/orders',[ApiCourierController::class,'orderView']);
Route::get('/courier/acceptedOrders',[ApiCourierController::class,'AcceptedOrderView']);
Route::get('/courier/deliveredOrder/{order_id}',[ApiCourierController::class,'deliveredOrder']);
Route::get('/courier/{order_id}',[ApiCourierController::class,'acceptOrder']);
Route::post('/courier/profile',[ApiCourierController::class,'getProfile']);
Route::post('/courier/modify/profile',[ApiCourierController::class,'courierProfileEdit']);
Route::post('/courier/cashout',[ApiCourierController::class,'cashout']);
Route::post('/courier/cashoutView',[ApiCourierController::class,'cashoutView']);

//CUSTOMER --->AYESHA
Route::get('/customer/home',[APICustomerController::class,'home'])->middleware("AuthUserCustomer");
Route::post('/customer/account',[APICustomerController::class,'getInfo'])->middleware("AuthUserCustomer");
Route::post('/customer/modify/account',[APICustomerController::class,'customerModify'])->middleware("AuthUserCustomer");
Route::get('/customer/medlist',[APICustomerController::class,'showMed'])->middleware("AuthUserCustomer");
Route::post('/customer/chart',[APICustomerController::class,'showChart'])->middleware("AuthUserCustomer");
Route::post('/customer/chart/monthly',[APICustomerController::class,'showChartMonthly'])->middleware("AuthUserCustomer");
Route::post('/customer/chart/yearly',[APICustomerController::class,'showChartYearly'])->middleware("AuthUserCustomer");
Route::post('/customer/add/cart',[APICustomerController::class,'addToCart'])->middleware("AuthUserCustomer");
Route::get('/customer/cart',[APICustomerController::class,'showCart'])->middleware("AuthUserCustomer");
Route::post('/customer/deleteItem',[APICustomerController::class,'deleteItem'])->middleware("AuthUserCustomer");
Route::get('/customer/grandtotal',[APICustomerController::class,'getGrandTotal'])->middleware("AuthUserCustomer");
Route::post('/customer/confirmOrder',[APICustomerController::class,'confirmOrder'])->middleware("AuthUserCustomer");
Route::post('/customer/orders',[APICustomerController::class,'showOrders'])->middleware("AuthUserCustomer");
Route::get('/customer/{order_id}',[APICustomerController::class,'showItems'])->middleware("AuthUserCustomer");
Route::get('/customer/order/cancel/{order_id}',[APICustomerController::class,'cancelOrder'])->middleware("AuthUserCustomer");
Route::post('/customer/item/return',[APICustomerController::class,'returnItems'])->middleware("AuthUserCustomer");
Route::get('/customer/item/return/{id}',[APICustomerController::class,'return'])->middleware("AuthUserCustomer");
Route::post('/customer/search',[APICustomerController::class,'search'])->middleware("AuthUserCustomer");
Route::post('/customer/complain',[APICustomerController::class,'complainEmail'])->middleware("AuthUserCustomer");


//MANAGER ---> TONMOY
//homepage
Route::get('/manager/home',[ApiManagerController::class,'homepage'])->middleware("ApiManagerAuth");
//medicine table
Route::get('/manager/medicine',[ApiManagerController::class,'viewMed'])->middleware("ApiManagerAuth");
//user table
Route::get('/manager/user',[ApiManagerController::class,'viewUser'])->middleware("ApiManagerAuth");
//order table
Route::get('/manager/orders',[ApiManagerController::class,'viewOrders'])->middleware("ApiManagerAuth");
//delete medicine
Route::post('/manager/deleteMed',[ApiManagerController::class,'deleteMed'])->middleware("ApiManagerAuth");
//supply table
Route::get('/manager/supply',[ApiManagerController::class,'showSupply'])->middleware("ApiManagerAuth");
//go to cart
Route::get('/manager/cart',[ApiManagerController::class,'showSupply'])->middleware("ApiManagerAuth");
//add item to cart
Route::post('/manager/addItem',[ApiManagerController::class,'addItem'])->middleware("ApiManagerAuth");
//view final cart
Route::get('/manager/cart/view',[ApiManagerController::class,'finalCart'])->middleware("ApiManagerAuth");
//view cart
Route::get('/manager/cart/table',[ApiManagerController::class,'viewCart'])->middleware("ApiManagerAuth");
//confirm order
Route::post('/manager/confirm',[ApiManagerController::class,'confirm'])->middleware("ApiManagerAuth");
//contract table
Route::get('/manager/contract',[ApiManagerController::class,'showContract'])->middleware("ApiManagerAuth");
//delete contract
Route::post('/manager/deleteContract',[ApiManagerController::class,'deleteContract'])->middleware("ApiManagerAuth");
//query table
Route::get('/manager/query',[ApiManagerController::class,'showQuery'])->middleware("ApiManagerAuth");
//accept query
Route::post('/manager/acceptQuery',[ApiManagerController::class,'acceptQuery'])->middleware("ApiManagerAuth");
//reject query
Route::post('/manager/declineQuery',[ApiManagerController::class,'declineQuery'])->middleware("ApiManagerAuth");
//account table
Route::get('/manager/account',[ApiManagerController::class,'showAccount'])->middleware("ApiManagerAuth");
//med details
Route::post('/manager/med/detail/{id}',[ApiManagerController::class,'medDetail'])->middleware("ApiManagerAuth");
//order details
Route::post('/manager/orders/detail/{id}',[ApiManagerController::class,'ordersDetail'])->middleware("ApiManagerAuth");
//contract details
Route::post('/manager/contract/detail/{id}',[ApiManagerController::class,'contractDetail'])->middleware("ApiManagerAuth");
//supply details
Route::post('/manager/supply/detail/{id}',[ApiManagerController::class,'supplyDetail'])->middleware("ApiManagerAuth");
//search view
Route::get('/manager/searching',[ApiManagerController::class,'searchView'])->middleware("ApiManagerAuth");
//search
Route::post('/manager/search/user',[ApiManagerController::class,'searchUser'])->middleware("ApiManagerAuth");
//user detail
Route::post('/manager/user/detail/{id}',[ApiManagerController::class,'userDetail'])->middleware("ApiManagerAuth");
//user delete
Route::post('/manager/deleteUser',[ApiManagerController::class,'deleteUser'])->middleware("ApiManagerAuth");
//change password
Route::post('/manager/change/pass',[ApiManagerController::class,'passChange'])->middleware("ApiManagerAuth");
//get Profile Picture
Route::post('/manager/propic',[ApiManagerController::class,'getProPic'])->middleware("ApiManagerAuth");
//change pro pic
Route::post('/manager/upload/propic',[ApiManagerController::class,'changeProPic'])->middleware("ApiManagerAuth");
//view profile
Route::post('/manager/profile/view',[ApiManagerController::class,'viewProfile'])->middleware("ApiManagerAuth");
//account monthly chart
Route::get('/manager/monthly',[ApiManagerController::class,'monthlyChart']);
//account yearly chart
Route::get('/manager/yearly',[ApiManagerController::class,'yearlyChart'])->middleware("ApiManagerAuth");
//remove from cart
Route::post('/manager/remove',[ApiManagerController::class,'removeItem'])->middleware("ApiManagerAuth");

