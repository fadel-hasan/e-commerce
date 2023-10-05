<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dashboard\DashboardController;
use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;
use function PHPUnit\Framework\throwException;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/clear-cache', function () {
//     Artisan::call('optimize:clear');
//     echo Artisan::output();
//     dd(Artisan::output());
// });
// Auth
Route::prefix('auth')->group(function () {
    Route::middleware('check.not.registered')->group(function () {
        Route::get('signup', [AuthController::class, 'getSignup'])->name('get.signup');
        Route::get('login', [AuthController::class, 'getLogin'])->name('get.login');
        Route::post('signup', [AuthController::class, 'postSignup'])->middleware('log.activity:عملية تسجيل في الموقع')->name('signup');
        Route::post('login', [AuthController::class, 'postLogin'])->middleware('log.activity:عملية تسجيل دخول في الموقع')->name('login');
        Route::get('forget-password', [AuthController::class, 'forgetPassword'])->name('forget.password');
        Route::post('forget-password', [AuthController::class, 'forgetPasswordPost'])->name('forget.password.post');
        Route::get('reset-password/{token}', [AuthController::class, 'resetPassword'])->name('reset.password');
        Route::post('reset-password', [AuthController::class, 'resetPasswordPost'])->name('reset.password.post');
        Route::get('account/verify/{token}', [AuthController::class, 'verifyAccount'])->name('user.verify');
    });

    Route::middleware(['auth', 'log.activity:عملية تسجيل خروج من الموقع'])->get('logout', [AuthController::class, 'logout'])->name('logout');
});
// Site
Route::controller(\App\Http\Controllers\Site\IndexsController::class)->group(function () {
    Route::get('/','index')->name('home'); // Home page
    Route::get('/search/{searchOut}','search')->name('search'); // Search page
    Route::get('/category/{uri}','category')->name('user.category'); // category
    Route::get('/product/{uri}','product')->name('user.product'); // Product page
    Route::get('/privacy-policy','showTextMarkdown')->name('privacyPolicy'); // privacy Policy
    Route::get('/terms-of-use','showTextMarkdown')->name('termsOfUse'); // privacy Policy
    Route::get('/refund-of-funds','showTextMarkdown')->name('refundOfFunds'); // privacy Policy
    // Member
    Route::prefix('/member')->middleware('auth')->group(function() {
        Route::get('/','profile')->name('user.profile');
        Route::get('/history/{sort_by?}/{sort_order?}','history')->name('user.history');
    });
});
Route::middleware('auth')->controller(\App\Http\Controllers\PaymentGateways\PaymentController::class)->group(function ()
{
    Route::post('/payment/{id}','createOrder')->name('user.payment');
    Route::match(['get','post'],'/paymentOrder/{paymentOrder}','viewOrder')->name('user.payment.order');
    Route::post('/paymentOrder/{paymentOrder}','payOrder')->name('user.payment.pay')->where('id','[0-9]+')/* ->where('paymentMethod','('.implode('|',array_keys(\App\Http\Controllers\Site\ConstDataController::paymentMethod)).')') */;
    Route::match(['post','get'],'/paymentMethod/{method}','afterPay')->where('method','payeer');
});
