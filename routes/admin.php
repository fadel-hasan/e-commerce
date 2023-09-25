<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Dashboard\VarController;
use App\Http\Controllers\Dashboard\DashboardController;

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
    Route::get('/sitting', fn () => view('pages.dashboard.sitting', [
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
            [
                'to' => route('dashboard.history'),
                'icon' => 'fa-solid fa-history',
                'title' => "السجلات"
            ],
            [
                'to' => route('dashboard.add-admin'),
                'icon' => 'fa-solid fa-user',
                'title' => "إضافة أدمن"
            ],
            [
                'to' => route('dashboard.sitting'),
                'icon' => 'fa-solid fa-cog',
                'title' => "الإعدادات"
            ],
            [
                'to' => route('dashboard.add-category'),
                'icon' => 'fa-solid fa-book',
                'title' => "إضافة قسم"
            ],
            [
                'to' => route('dashboard.add-product'),
                'icon' => 'fa-solid fa-shop',
                'title' => "إضافة منتج"
            ],
            [
                'to' => route('dashboard.add-coupon'),
                'icon' => 'fa-solid fa-tags',
                'title' => "إضافة خصم"
            ],
        ],
        'isAuth' => true,
        'commands' => [
            [
                'name' => "اسم الموقع",
                'type' => "text",
                'id' => "title",
                'required' => true,
                'value' => "العنوان"
            ],
            [
                'name' => "الوصف",
                'type' => "text",
                'id' => "des",
                'required' => true,
                'value' => "وصف"
            ],
            [
                'name' => "العلامات الوصفية",
                'type' => "text",
                'id' => "tags",
                'required' => true,
                'value' => "tag1,tag2,tag3"
            ],
            [
                'name' => "صورة الموقع",
                'type' => "file",
                'id' => "file",
                'required' => false,
                'value' => ""
            ],
            [
                'name' => "ايدي حساب الفيسبوك",
                'type' => "text",
                'id' => "facebook",
                'required' => false,
                'value' => ""
            ],
            [
                'name' => "معرف حساب تويتر",
                'type' => "text",
                'id' => "twiiter",
                'required' => false,
                'value' => ""
            ],
        ]
    ]))->name('dashboard.sitting');
    Route::get('/add-category', fn () => view('pages.dashboard.add-category', [
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
            [
                'to' => route('dashboard.history'),
                'icon' => 'fa-solid fa-history',
                'title' => "السجلات"
            ],
            [
                'to' => route('dashboard.add-admin'),
                'icon' => 'fa-solid fa-user',
                'title' => "إضافة أدمن"
            ],
            [
                'to' => route('dashboard.sitting'),
                'icon' => 'fa-solid fa-cog',
                'title' => "الإعدادات"
            ],
            [
                'to' => route('dashboard.add-category'),
                'icon' => 'fa-solid fa-book',
                'title' => "إضافة قسم"
            ],
            [
                'to' => route('dashboard.add-product'),
                'icon' => 'fa-solid fa-shop',
                'title' => "إضافة منتج"
            ],
            [
                'to' => route('dashboard.add-coupon'),
                'icon' => 'fa-solid fa-tags',
                'title' => "إضافة خصم"
            ],
        ],
        'isAuth' => true
    ]))->name('dashboard.add-category');
    Route::get('/add-product', fn () => view('pages.dashboard.add-product', [
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
            [
                'to' => route('dashboard.history'),
                'icon' => 'fa-solid fa-history',
                'title' => "السجلات"
            ],
            [
                'to' => route('dashboard.add-admin'),
                'icon' => 'fa-solid fa-user',
                'title' => "إضافة أدمن"
            ],
            [
                'to' => route('dashboard.sitting'),
                'icon' => 'fa-solid fa-cog',
                'title' => "الإعدادات"
            ],
            [
                'to' => route('dashboard.add-category'),
                'icon' => 'fa-solid fa-book',
                'title' => "إضافة قسم"
            ],
            [
                'to' => route('dashboard.add-product'),
                'icon' => 'fa-solid fa-shop',
                'title' => "إضافة منتج"
            ],
            [
                'to' => route('dashboard.add-coupon'),
                'icon' => 'fa-solid fa-tags',
                'title' => "إضافة خصم"
            ],
        ],
        'isAuth' => true
    ]))->name('dashboard.add-product');
    Route::get('/add-coupon', fn () => view('pages.dashboard.add-coupon', [
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
            [
                'to' => route('dashboard.history'),
                'icon' => 'fa-solid fa-history',
                'title' => "السجلات"
            ],
            [
                'to' => route('dashboard.add-admin'),
                'icon' => 'fa-solid fa-user',
                'title' => "إضافة أدمن"
            ],
            [
                'to' => route('dashboard.sitting'),
                'icon' => 'fa-solid fa-cog',
                'title' => "الإعدادات"
            ],
            [
                'to' => route('dashboard.add-category'),
                'icon' => 'fa-solid fa-book',
                'title' => "إضافة قسم"
            ],
            [
                'to' => route('dashboard.add-product'),
                'icon' => 'fa-solid fa-shop',
                'title' => "إضافة منتج"
            ],
            [
                'to' => route('dashboard.add-coupon'),
                'icon' => 'fa-solid fa-tags',
                'title' => "إضافة خصم"
            ],
        ],
        'isAuth' => true
    ]))->name('dashboard.add-coupon');
});

Route::get('try', [VarController::class, 'get_latest_users']);
