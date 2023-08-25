<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    // return "Welcome<br>You can go to <a href='".Route('login')."'>Login</a>";
    return redirect(route('dashboard'));
})->name('home');

// Auth
Route::prefix('auth')->group(function () {

    Route::middleware('check.not.registered')->group(function () {
        Route::get('signup', [AuthController::class, 'getSignup'])->name('get.signup');
        Route::get('login', [AuthController::class, 'getLogin'])->name('get.login');
        Route::post('signup', [AuthController::class, 'postSignup'])->name('signup');
        Route::post('login', [AuthController::class, 'postLogin'])->name('login');
        Route::get('forget-password', [AuthController::class, 'forgetPassword'])->name('forget.password');
        Route::post('forget-password', [AuthController::class, 'forgetPasswordPost'])->name('forget.password.post');
        Route::get('reset-password/{token}', [AuthController::class, 'resetPassword'])->name('reset.password');
        Route::post('reset-password', [AuthController::class, 'resetPasswordPost'])->name('reset.password.post');
    });

    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});
// Search
Route::get('/search/{name}', function ($name) {
    return "Search Aboud {$name}";
});
// Dashboard
Route::prefix('dashboard')/* ->middleware('auth') */->group(function () {
    Route::get('/', fn () => view('pages.dashboard.home', ['isAuth' => true, 'adminLinks' => [['to' => route('dashboard'), 'icon' => 'fa-solid fa-home', 'title' => "الصفحة الرئيسية"]]]))->name('dashboard');
});
