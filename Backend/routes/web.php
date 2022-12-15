<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AllUserController;
use App\Http\Controllers\CourierController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\vendorcontroller; 

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
    return redirect('/login');
});

//ALL USERS*************************************************************************************************************************

Route::get('/registration',[AllUserController::class,'registration'])->name('user.registration');
Route::post('/registration',[AllUserController::class,'registrationSubmit'])->name('user.registration.submit');

Route::get('/registration/{type}',[AllUserController::class,'register'])->name('user.register');
Route::post('/registration/{type}',[AllUserController::class,'registerSubmit'])->name('user.register.submit');

Route::get('/login',[AllUserController::class,'login'])->name('user.login');
Route::post('/login',[AllUserController::class,'loginSubmit'])->name('user.login.submit');

Route::get('/logout',[AllUserController::class,'logout'])->name('logout');


//OTP SENDING AND CHANGING PASSWORD

Route::get('/forgotpassword',[AllUserController::class,'forgotPassword'])->name('user.forgot.password');
Route::post('/forgotpassword',[AllUserController::class,'forgotPasswordVerify'])->name('user.forgot.password.verify');

Route::get('/verify/{email}',[AllUserController::class,'OTP'])->name('user.otp')->middleware('AuthChangePassword');
Route::post('/verify/{email}',[AllUserController::class,'OTPverify'])->name('user.verify.otp')->middleware('AuthChangePassword');

Route::get('/changePassword/{email}',[AllUserController::class,'ChangePassword'])->name('user.change.password')->middleware('AuthChangePassword');
Route::post('/changePassword/{email}',[AllUserController::class,'ChangedPassword'])->name('user.changed.password')->middleware('AuthChangePassword');



//CUSTOMER**************************************************************************************************************************************
Route::get('/customer/home',[CustomerController::class,'customerHome'])->name('customer.home')->middleware('AuthCustomer');
Route::post('/customer/home',[CustomerController::class,'addToCart'])->name('customer.home.add.to.cart')->middleware('AuthCustomer');

Route::get('/customer/account/{name}',[CustomerController::class,'customerAccount'])->name('customer.account')->middleware('AuthCustomer');

Route::get('/customer/account/modify/{name}',[CustomerController::class,'customerModifyAccount'])->name('customer.modify.account')->middleware('AuthCustomer');
Route::post('/customer/account/modify/{name}',[CustomerController::class,'customerModifiedAccount'])->name('customer.modified.account')->middleware('AuthCustomer');


Route::get('/customer/show/MedicineList',[CustomerController::class,'showMed'])->name('customer.show.med')->middleware('AuthCustomer');
Route::post('/customer/show/MedicineList',[CustomerController::class,'addToCart'])->name('customer.add.to.cart')->middleware('AuthCustomer');

Route::get('/customer/cart',[CustomerController::class,'showCart'])->name('customer.show.cart')->middleware('AuthCustomer');
Route::post('/customer/cart',[CustomerController::class,'confirmOrder'])->name('customer.confirm.order')->middleware('AuthCustomer');

Route::get('/customer/cart/remove/{item_id}',[CustomerController::class,'deleteItem'])->name('customer.delete.from.cart')->middleware('AuthCustomer');

Route::get('/customer/clearcart',[CustomerController::class,'clearCart'])->name('customer.clear.cart')->middleware('AuthCustomer');

Route::get('/customer/checkout',[CustomerController::class,'checkOut'])->name('customer.check.out')->middleware('AuthCustomer');

Route::get('/customer/orders',[CustomerController::class,'showOrders'])->name('customer.show.order')->middleware('AuthCustomer');
Route::get('/customer/order/details/{order_id}',[CustomerController::class,'showOrderDetails'])->name('customer.order.details')->middleware('AuthCustomer');

Route::get('/customer/return',[CustomerController::class,'returnItem'])->name('customer.return')->middleware('AuthCustomer');
Route::post('/customer/return',[CustomerController::class,'returnedItem'])->name('customer.returned')->middleware('AuthCustomer');

Route::get('/customer/order/cancel/{order_id}',[CustomerController::class,'cancelOrder'])->name('customer.order.cancel')->middleware('AuthCustomer');

Route::get('/customer/complain',[CustomerController::class,'complain'])->name('customer.complain')->middleware('AuthCustomer');
Route::post('/customer/complain',[CustomerController::class,'complainEmail'])->name('customer.complain.email')->middleware('AuthCustomer');

Route::get('/customer/change_password',[CustomerController::class,'changePass'])->name('customer.change.pass')->middleware('AuthCustomer');
Route::post('/customer/change_password',[CustomerController::class,'changedPass'])->name('customer.changed.pass')->middleware('AuthCustomer');





//MANAGER****************************************************************************************************************************************

//Homepage
Route::get('/manager/home',[ManagerController::class,'managerHome'])->name('manager.home')->middleware('managerAuth');
Route::post('/manager/home',[ManagerController::class,'HomeAction'])->name('manager.HomeAction')->middleware('managerAuth');
//User Table Selecting
Route::get('/manager/table/select',[ManagerController::class,'tableSelect'])->name('manager.tableSelect')->middleware('managerAuth');
Route::post('/manager/table/select',[ManagerController::class,'viewTable'])->name('manager.tableView')->middleware('managerAuth');
//User Table View
Route::get('/manager/table/customer',[ManagerController::class,'viewCustomer'])->name('manager.tableCustomer')->middleware('managerAuth');
Route::get('/manager/table/vendor',[ManagerController::class,'viewVendor'])->name('manager.tableVendor')->middleware('managerAuth');
Route::get('/manager/table/courier',[ManagerController::class,'viewCourier'])->name('manager.tableCourier')->middleware('managerAuth');
Route::get('/manager/table/manager',[ManagerController::class,'viewManager'])->name('manager.tableManager')->middleware('managerAuth');
//User Table Functions
Route::get('/manager/table/info/{id}',[ManagerController::class, 'userInfo'])->name('user.info')->middleware('managerAuth');
Route::get('/manager/table/info/delete/{id}',[ManagerController::class, 'userDelete'])->name('user.delete')->middleware('managerAuth');
// View Query
Route::get('/manager/table/query',[ManagerController::class,'viewQuery'])->name('manager.tableViewQuery')->middleware('managerAuth');
//Medicine Table View And Function
Route::get('/manager/table/medicine',[ManagerController::class,'viewMed'])->name('manager.tableMedicine')->middleware('managerAuth');
Route::get('/manager/table/info/med/{id}',[ManagerController::class, 'medInfo'])->name('med.info')->middleware('managerAuth');
Route::get('/manager/table/info/med/delete/{id}',[ManagerController::class, 'medDelete'])->name('med.delete')->middleware('managerAuth');
//Order Table View And Function
Route::get('/manager/table/order',[ManagerController::class,'viewOrder'])->name('manager.tableOrder')->middleware('managerAuth');
Route::get('/manager/table/info/order/{id}',[ManagerController::class, 'orderInfo'])->name('order.info')->middleware('managerAuth');
//Contract Table View And Function
Route::get('/manager/table/contract',[ManagerController::class,'viewContract'])->name('manager.tableContracts')->middleware('managerAuth');
Route::get('/manager/table/info/contract/{id}',[ManagerController::class, 'contractInfo'])->name('contract.info')->middleware('managerAuth');
Route::get('/manager/table/info/contract/delete/{id}',[ManagerController::class, 'contractDelete'])->name('contract.delete')->middleware('managerAuth');
//Supply Table View And Function
Route::get('/manager/table/supply',[ManagerController::class,'viewSupply'])->name('manager.tableSupply')->middleware('managerAuth');
Route::get('/manager/table/info/supply/{id}',[ManagerController::class, 'supplyInfo'])->name('supply.info')->middleware('managerAuth');
//View and Add to Cart
Route::get('/manager/table/supply/order',[ManagerController::class,'supplyOrder'])->name('manager.tableSupplyOrder')->middleware('managerAuth');
Route::post('/manager/table/supply/order',[ManagerController::class,'addCart'])->name('manager.addCart')->middleware('managerAuth');
//View Cart and Confirm Order
Route::get('/manager/table/supply/cart',[ManagerController::class,'viewSupplyCart'])->name('manager.tableSupplyCart')->middleware('managerAuth');
Route::post('/manager/table/supply/cart',[ManagerController::class,'confirm'])->name('manager.cartConfirm')->middleware('managerAuth');
//Remove from Cart
Route::get('/manager/table/supply/cart/remove/{id}',[ManagerController::class,'removeCart'])->name('manager.removeCart')->middleware('managerAuth');
//View Profile
Route::get('/manager/profile',[ManagerController::class,'viewProfile'])->name('manager.profile')->middleware('managerAuth');
Route::post('/manager/profile',[ManagerController::class,'editProfile'])->name('manager.editProfile')->middleware('managerAuth');
//Edit Profile
Route::get('/manager/profile/edit',[ManagerController::class,'viewEdit'])->name('manager.editPage')->middleware('managerAuth');
Route::post('/manager/profile/edit',[ManagerController::class,'confirmEdit'])->name('manager.editProfile')->middleware('managerAuth');
//Query accept
Route::get('/manager/table/query/accept/{id}',[ManagerController::class, 'queryAcc'])->name('query.accept')->middleware('managerAuth');
//Query reject
Route::get('/manager/table/query/reject/{id}',[ManagerController::class, 'queryDec'])->name('query.deny')->middleware('managerAuth');
//search in user
Route::get('/manager/search/user',[ManagerController::class, 'searchUser'])->name('search.user')->middleware('managerAuth');
//search in medicine
Route::get('/manager/search/Medicine',[ManagerController::class, 'searchMedicine'])->name('search.medicine')->middleware('managerAuth');
//search in contract
Route::get('/manager/search/contract',[ManagerController::class, 'searchContract'])->name('search.contract')->middleware('managerAuth');
//search in order
Route::get('/manager/search/order',[ManagerController::class, 'searchOrder'])->name('search.order')->middleware('managerAuth');
//search in supply
Route::get('/manager/search/supply',[ManagerController::class, 'searchSupply'])->name('search.supply')->middleware('managerAuth');
//view account table
Route::get('/manager/table/account',[ManagerController::class,'viewAccount'])->name('manager.tableViewAccount')->middleware('managerAuth');


//vendor-----------------------------------
//sweet.home
Route::get('/vendor/home',[vendorcontroller::class,'home'])->name('vendor.home')->middleware('authvendor');
//profile edit
Route::get('/vendor/profile/edit',[vendorcontroller::class,'editprofile'])->name('vendor.edit.account')->middleware('authvendor');
Route::post('/vendor/profile/edit',[vendorcontroller::class,'editedprofile'])->name('vendor.edited.account')->middleware('authvendor');
//profile
Route::get('/vendor/profile',[vendorcontroller::class,'profile'])->name('vendor.profile')->middleware('authvendor');

//contract
Route::get('/vendor/contracts',[vendorcontroller::class,'contracts'])->name('vendor.contracts')->middleware('authvendor');
Route::get('/vendor/contractdetails/{contract_id}',[vendorcontroller::class,'contractdetails'])->name('vendor.contractdetails')->middleware('authvendor');
Route::post('/vendor/contractdetails/{contract_id}',[vendorcontroller::class,'contractstatus'])->name('vendor.contractstatus')->middleware('authvendor');

//supply
Route::get('/vendor/supply',[vendorcontroller::class,'supply'])->name('vendor.supply')->middleware('authvendor');
Route::get('/vendor/addsupply',[vendorcontroller::class,'addsupply'])->name('vendor.addsupply')->middleware('authvendor');
Route::post('/vendor/addsupply',[vendorcontroller::class,'addedsupply'])->name('vendor.addedsupply')->middleware('authvendor');
Route::get('/vendor/supply/update/{supply_id}',[vendorcontroller::class,'updatesupply'])->name('vendor.updatesupply')->middleware('authvendor');
Route::post('/vendor/supply/update/{supply_id}',[vendorcontroller::class,'updatedsupply'])->name('vendor.updatedsupply')->middleware('authvendor');
Route::get('/vendor/supply/delete/{supply_id}',[vendorcontroller::class,'deletesupply'])->name('vendor.deletesupply')->middleware('authvendor');

//market
Route::get('/vendor/market',[vendorcontroller::class,'market'])->name('vendor.market')->middleware('authvendor');



//Courier***************************************************************************************************************************************
Route::get('/courier/home',[CourierController::class,'courierHome'])->name('courier.home')->middleware('courierAuth');
Route::get('/courier/profile/{id}',[CourierController::class,'courierProfile'])->name('courier.profile')->middleware('courierAuth');
Route::get('/courier/order',[CourierController::class,'orderView'])->name('courier.order')->middleware('courierAuth');
Route::get('/courier/acceptedOrder',[CourierController::class,'AcceptedOrderView'])->name('courier.AcceptedOrder')->middleware('courierAuth');
Route::get('/courier/{order_id}',[CourierController::class,'acceptOrder'])->name('order.accept')->middleware('courierAuth');
Route::get('/courier/deliverd/{order_id}',[CourierController::class,'deliveredOrder'])->name('order.deliverd')->middleware('courierAuth');
Route::get('/courier/mail/{order_id}',[CourierController::class,'sendMail'])->name('courier.mail')->middleware('courierAuth');
Route::post('/courier/profile/{id}',[CourierController::class,'courierProfileEdit'])->name('courier.profile.edit')->middleware('courierAuth');
Route::get('/courier/cashout/{id}',[CourierController::class,'cashoutView'])->name('courier.cashoutView')->middleware('courierAuth');
Route::post('/courier/cashout/{id}',[CourierController::class,'cashout'])->name('courier.cashout')->middleware('courierAuth');