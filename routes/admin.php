<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    Route::get('/dashboard', fn () => view('pages.dashboard.home', [
        'isAuth' => true,
        'adminLinks' => [
            [
                'to' => route('dashboard'),
                'icon' => 'fa-solid fa-home',
                'title' => "الصفحة الرئيسية"
            ],
            [
                'to' => route('dashboard.member'),
                'icon' => 'fa-solid fa-users',
                'title' => "الأعضاء"
            ],
            [
                'to' => route('dashboard.analysis'),
                'icon' => 'fa-solid fa-chart-line',
                'title' => "الإحصائيات"
            ],
        ],
        'boxs' => [
            [
                'title' => 'عدد المنتجات',
                'icon' => 'fa-solid fa-cart-shopping',
                'number' => '200'
            ],
            [
                'title' => 'عدد البائعين',
                'icon' => 'fa-solid fa-users',
                'number' => '5'
            ],
            [
                'title' => 'عدد الأعضاء',
                'icon' => 'fa-solid fa-circle-user',
                'number' => '200'
            ],
            [
                'title' => 'إجمالي المبيعات',
                'icon' => 'fa-solid fa-tags',
                'number' => '400'
            ],
            [
                'title' => 'مبيعات اليوم',
                'icon' => 'fa-solid fa-cart-arrow-down',
                'number' => '200'
            ],
            [
                'title' => 'زيارات اليوم',
                'icon' => 'fa-solid fa-calendar-days',
                'number' => '245'
            ],
            [
                'title' => 'زيارات الشهر',
                'icon' => 'fa-regular fa-calendar-days',
                'number' => '2450'
            ],
            [
                'title' => 'إجمالي الربح',
                'icon' => 'fa-solid fa-coins',
                'number' => '2500' . '$'
            ],
        ],
    ]))->name('dashboard');
    Route::get('/member', fn () => view('pages.dashboard.member', [
        'adminLinks' => [
            [
                'to' => route('dashboard'),
                'icon' => 'fa-solid fa-home',
                'title' => "الصفحة الرئيسية"
            ],
            [
                'to' => route('dashboard.member'),
                'icon' => 'fa-solid fa-users',
                'title' => "الأعضاء"
            ],
            [
                'to' => route('dashboard.analysis'),
                'icon' => 'fa-solid fa-chart-line',
                'title' => "الإحصائيات"
            ],
        ],
        'isAuth' => true
    ]))->name('dashboard.member');
    Route::get('/analysis', fn () => view('pages.dashboard.analysis', [
        'adminLinks' => [
            [
                'to' => route('dashboard'),
                'icon' => 'fa-solid fa-home',
                'title' => "الصفحة الرئيسية"
            ],
            [
                'to' => route('dashboard.member'),
                'icon' => 'fa-solid fa-users',
                'title' => "الأعضاء"
            ],
            [
                'to' => route('dashboard.analysis'),
                'icon' => 'fa-solid fa-chart-line',
                'title' => "الإحصائيات"
            ],
        ],
        'isAuth' => true
    ]))->name('dashboard.analysis');
});