<?php

use App\Http\Controllers\Dashboard\Add_adminController;
use App\Http\Controllers\Dashboard\CoponController;
use App\Http\Controllers\Dashboard\Edit_productController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\SectionController;
use App\Http\Controllers\Site\ProductController as SiteProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentGateways\CoponController as CoponApi;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix(env('PASSWORD_API'))->group(function () {
    Route::get('/removeAdmin', [Add_adminController::class, 'delete'])->middleware('log.activity: عملية ازالة ادمن')->name('removeAdmin');
    Route::get('/removeSec', [SectionController::class, 'delete'])->middleware('log.activity:عملية ازالة قسم')->name('removeSec');
    Route::get('/removeProduct', [ProductController::class, 'delete'])->middleware('log.activity:عملية ازالة منتج')->name('removeProduct');
    Route::get('/removeCoupon', [CoponController::class, 'delete'])->middleware('log.activity:عملية ازالة كوبون')->name('removeCoupon');
    Route::get('/removeDev',[Edit_productController::class,'delete'])->middleware('log.activity:عملية ازالة تطوير لمنتج')->name('removeDev');
});
// it isn't important
Route::get('/products',[SiteProductController::class,'get_product'])->name('productesGet');
Route::get('/product_section/{uri}',[SiteProductController::class,'get_product_section'])->name('productSectionGet');
Route::get('/copon/{code}',[CoponApi::class,'index']);
