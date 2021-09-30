<?php

use App\Http\Controllers\BillController;
use App\Http\Controllers\DayBookController;
use App\Http\Controllers\ExpenceController;
use App\Http\Controllers\GstrController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PurchaseBillController;
use App\Http\Controllers\SaleBillController;
use App\Http\Controllers\StoreController;
use GuzzleHttp\Middleware;

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

//creating routes
Route::post('/auth/save',[MainController::class,'save'])->name('auth.save');

Route::post('/auth/check',[MainController::class,'check'])->name('auth.check');

Route::post('/auth/storecheck',[MainController::class,'storecheck'])->name('auth.storecheck');

Route::get('/auth/logout',[MainController::class,'logout'])->name('auth.logout');

// test
Route::get('/admin/bill',[MainController::class,'viewbill'])->name('admin.bills');
// test close

// make route group to protect the route using middleware

Route::group(['middleware'=>['AuthCheck']], function(){

Route::get('/',[MainController::class,'login'])->name('auth.login');

Route::get('/admin/getStores',[StoreController::class,'index'])->name('admin.getStores');

//Route::get('/auth/login',[MainController::class,'login'])->name('auth.login');

Route::get('/register',[MainController::class,'register'])->name('auth.register');

Route::get('/admin/dashboard',[MainController::class,'dashboard'])->name('admin.dashboard');

// Store Management

Route::get('/admin/addstore',[StoreController::class,'addstore'])->name('admin.addstore');

Route::post('/admin/createstore',[StoreController::class,'createstore'])->name('admin.createstore');

Route::get('/admin/managestore',[StoreController::class,'managestore'])->name('admin.managestore');

Route::get('/admin/activatestore/{id}',[StoreController::class,'activatestore'])->name('admin.activatestore');

Route::get('/admin/blockstore/{id}',[StoreController::class,'blockstore'])->name('admin.blockstore');

Route::get('/admin/removestore/{id}',[StoreController::class,'removestore'])->name('admin.removestore');

Route::get('/admin/editstore/{id}',[StoreController::class,'editstore'])->name('admin.editstore');

Route::post('/admin/updatestote/{id}',[StoreController::class,'updatestote'])->name('admin.updatestote');

// Gstr Management

Route::get('/admin/addgstslab',[GstrController::class,'addgstrtype'])->name('admin.addgstrtype');

Route::post('/admin/creategstslab',[GstrController::class,'creategstslab'])->name('admin.creategstslab');

Route::get('/admin/managegstslabs',[GstrController::class,'managegstslabs'])->name('admin.managegstslabs');

Route::get('/admin/removeslab/{id}',[GstrController::class,'removeslab'])->name('admin.removeslab');

//  sale bill management 

Route::get('/admin/salebill',[SaleBillController::class,'salebillview'])->name('admin.salebillview');

Route::post('/admin/addsalebill',[SaleBillController::class,'addsalebill'])->name('admin.addsalebill');

//  purchase bill management 

Route::get('/admin/purchasebill',[PurchaseBillController::class,'purchasebillview'])->name('admin.purchasebillview');

Route::post('/admin/addpurchasebill',[PurchaseBillController::class,'addpurchasebill'])->name('admin.addpurchasebill');

//  Expene management 

Route::get('/admin/expense',[ExpenceController::class,'recordexpence'])->name('admin.recordexpence');

Route::post('/admin/addexpenses',[ExpenceController::class,'addexpences'])->name('admin.addexpences');

// DayBook management 

Route::get('/admin/viewdaybook',[DayBookController::class,'viewDayBook'])->name('admin.viewDayBook');

Route::get('/admin/viewstoredaybook/{id}',[DayBookController::class,'viewStoreDayBook'])->name('admin.viewStoreDayBook');

Route::get('/admin/viewAllStoreDayBook/{id}',[DayBookController::class,'viewAllStoreDayBook'])->name('admin.viewAllStoreDayBook');

// expanded daybook

Route::get('/admin/viewExpandedDayBook/{stc}/{bdat}',[DayBookController::class,'viewExpandedDayBook'])->name('admin.viewExpandedDayBook');

//  bill details billdetails

Route::get('/admin/viewbilldetails/{id}',[BillController::class,'viewbilldetails'])->name('admin.viewbilldetails');

Route::get('/admin/viewIndividualDayBook',[DayBookController::class,'viewIndividualDayBook'])->name('admin.viewIndividualDayBook');

Route::get('/admin/viewStoreExpandedDayBook/{stc}/{bdat}',[DayBookController::class,'viewStoreExpandedDayBook'])->name('admin.viewStoreExpandedDayBook');

// report 

 Route::get('/admin/storeindividualReport/{id}',[DayBookController::class,'storeindividualReport'])->name('admin.storeindividualReport');

//  store daily report 


Route::post('/admin/viewStoreDailyReport',[DayBookController::class,'viewStoreDailyReport'])->name('admin.viewStoreDailyReport');

Route::post('/admin/viewStoreMonthlyReport',[DayBookController::class,'viewStoreMonthlyReport'])->name('admin.viewStoreMonthlyReport');

});

