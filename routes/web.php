<?php

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
    return "
    Welecome<br>You can go to <a href='".Route('login')."'>Login</a>
    ";
});

// Auth
Route::prefix('auth')->group(function() {
    Route::get('login',fn() => view('pages.auth.login',['isAuth'=>false]))->name('login');
    Route::get('signup',fn() => view('pages.auth.signup',['isAuth'=>true]))->name('signup');
    // POST login + signup
    Route::get('logout',fn() => 'logout')->name('logout');
});
// Search 
Route::get('/search/{name}',function ($name) {
    return "Search Aboud {$name}";
});
// Dashboard
Route::prefix('dashboard')->middleware('auth')->group(function () {
    
});