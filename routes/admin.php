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
// use middleware is_verify_email at end
Route::middleware(['admin:admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class,'index'])->middleware('log.activity:تصفح لوحة الأدمن الرئيسية')->name('dashboard');
    Route::get('/member/{sort_by?}/{sort_order?}', [DashboardController::class,'indexMember'])->middleware('log.activity:تصفح صفحة الأعضاء')->name('dashboard.member');
    Route::get('/analysis', [DashboardController::class,'indexAnalysis'])->middleware('log.activity:تصفح صفحة الإحصائيات')->name('dashboard.analysis');
    Route::get('/history', [DashboardController::class,'indexHistory'])->middleware('log.activity:تصفح صفحة السجلات')->name('dashboard.history');
    Route::post('/history', [DashboardController::class,'indexHistory'])->middleware('log.activity:تصفح صفحة السجلات')->name('post.dashboard.history');
    Route::get('/orders', [DashboardController::class,'indexOrder'])->middleware('log.activity:تصفح صفحة الطلبات')->name('dashboard.orders');
    Route::get('/add-admin',[DashboardController::class,'indexAdmin'])->name('dashboard.add-admin')->middleware('log.activity:تصفح صفحة الأدمن');
    Route::post('/add-admin',[DashboardController::class,'indexAdmin'])->name('post.dashboard.add-admin')->middleware('log.activity:اضافة  ادمن');
    Route::match(['get', 'post'], '/sitting', [DashboardController::class,'indexSitting'])->name('dashboard.sitting')->middleware('log.activity:تصفح صفحة الإعدادات');
    Route::match(['get', 'post'],'/add-category', [DashboardController::class,'indexSection'])->name('dashboard.add-category')->middleware('log.activity:تصفح صفحة الأقسام');
    Route::match(['get', 'post'],'/add-product',[DashboardController::class,'indexProduct'])->name('dashboard.add-product')->middleware('log.activity:تصفح صفحة المنتجات');
    Route::match(['get', 'post'],'/edit-product/{idProduct}',[DashboardController::class,'editProduct'])->name('dashboard.edit-product')->middleware('log.activity:تصفح صفحة تعديل المنتج');
    Route::match(['get', 'post'],'/add-coupon', [DashboardController::class,'indexCoupon'])->name('dashboard.add-coupon')->middleware('log.activity:تصفح صفحة الكوبونات');
});

Route::get('try', [ProductController::class, 'get_product']);
