<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dashboard\DashboardController;
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

Route::get('/', function () {
    return view('pages.home');
    // return redirect(route('dashboard'));
})->name('home');


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

// Member
Route::prefix('/member')/* ->middleware() */->group(function() {
    Route::get('/',fn() => view('pages.site.profile'))->name('user.profile');
    Route::get('/refer',fn() => view('pages.site.refer'))->name('user.refer');
    Route::get('/history',fn() => view('pages.site.history'))->name('user.history');
});
// Search
Route::get('/search/{name}', function ($name) {
    return "Search Aboud {$name}";
})->name('search');
// product
Route::get('/product/{uri}',fn(string $uri) => view('pages.site.product'))->name('user.product');
// category
Route::get('/category/{uri}',fn(string $uri) => view('pages.site.category'))->name('user.category');
// payment
/**
 * @param int $id the payment
 * @param int $productId for pay
*/
function payment(int $id,int $productId) {
    view('pages.site.category');
}
Route::get('/payment/{id}/{productId}',payment($id,$productId))->name('user.category');
