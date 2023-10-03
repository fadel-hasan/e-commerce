<?php

use App\Http\Controllers\Dashboard\Add_adminController;
use App\Http\Controllers\Dashboard\CoponController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\SectionController;
use App\Http\Controllers\Site\ProductController as SiteProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
    Route::get('/removeAdmin', [Add_adminController::class, 'delete'])->name('removeAdmin');
    Route::get('/removeSec', [SectionController::class, 'delete'])->name('removeSec');
    Route::get('/removeProduct', [ProductController::class, 'delete'])->name('removeProduct');
    Route::get('/removeCoupon', [CoponController::class, 'delete'])->name('removeCoupon');
});
// it isn't important
Route::get('/products',[SiteProductController::class,'get_product'])->name('productesGet');
Route::get('/product_section/{uri}',[SiteProductController::class,'get_product_section'])->name('productSectionGet');
