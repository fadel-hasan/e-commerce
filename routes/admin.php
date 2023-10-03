<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Dashboard\VarController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\SittingController;
use App\Http\Controllers\Site\ProductController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/

Route::middleware('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class,'index'])->middleware('log.activity:تصفح لوحة الأدمن الرئيسية')->name('dashboard');
    Route::get('/member/{sort_by?}/{sort_order?}', [DashboardController::class,'indexMember'])->middleware('log.activity:تصفح صفحة الأعضاء')->name('dashboard.member');
    Route::get('/analysis', [DashboardController::class,'indexAnalysis'])->middleware('log.activity:تصفح صفحة الإحصائيات')->name('dashboard.analysis');
    Route::get('/history', [DashboardController::class,'indexHistory'])->middleware('log.activity:تصفح صفحة السجلات')->name('dashboard.history');
    Route::post('/history', [DashboardController::class,'indexHistory'])->middleware('log.activity:تصفح صفحة السجلات')->name('post.dashboard.history');
    Route::get('/add-admin',[DashboardController::class,'indexAdmin'])->name('dashboard.add-admin');
    Route::post('/add-admin',[DashboardController::class,'indexAdmin'])->name('post.dashboard.add-admin');
    Route::match(['get', 'post'], '/sitting', [DashboardController::class,'indexSitting'])->name('dashboard.sitting');
    Route::match(['get', 'post'],'/add-category', [DashboardController::class,'indexSection'])->name('dashboard.add-category');
    Route::match(['get', 'post'],'/add-product',[DashboardController::class,'indexProduct'])->name('dashboard.add-product');
    Route::match(['get', 'post'],'/add-coupon', [DashboardController::class,'indexCoupon'])->name('dashboard.add-coupon');
});

Route::get('try', [ProductController::class, 'get_product']);
