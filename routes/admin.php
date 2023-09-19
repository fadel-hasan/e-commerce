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
    Route::get('/', fn () => view('pages.dashboard.home', [
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
                'icon' => 'fa-solid fa-book',
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
    ]))->name('dashboard.analysis');
    Route::get('/history', fn () => view('pages.dashboard.history', [
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
    ]))->name('dashboard.history');
    Route::get('/add-admin', fn () => view('pages.dashboard.add-admin', [
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
    ]))->name('dashboard.add-admin');
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