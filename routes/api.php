<?php

use App\Http\Controllers\Dashboard\Add_adminController;
use App\Http\Controllers\Dashboard\SectionController;
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
});
// it isn't important
Route::get('/productesGet', function (): object {
    // remove sleep because i use it for chek style loding api
    sleep(2);
    return response([
        'ok' => true,
        'result' => [
            [
                'image'         => 'https://placehold.co/600x400.png',
                'title'         => "سيرفر رام 4",
                "des"           => "معنى remo, تعريف remo في قاموس المعاني الفوري مجال البحث مصطلحات المعاني ضمن قاموس عربي انجليزي.",
                "category"      => "سيرفرات",
                'link'          => "#",
                'linkCategory'  => "#"
            ],            [
                'image'         => 'https://placehold.co/600x400.png',
                'title'         => "سيرفر رام 4",
                "des"           => "معنى remo, تعريف remo في قاموس المعاني الفوري مجال البحث مصطلحات المعاني ضمن قاموس عربي انجليزي.",
                "category"      => "سيرفرات",
                'link'          => "#",
                'linkCategory'  => "#"
            ],            [
                'image'         => 'https://placehold.co/600x400.png',
                'title'         => "سيرفر رام 4",
                "des"           => "معنى remo, تعريف remo في قاموس المعاني الفوري مجال البحث مصطلحات المعاني ضمن قاموس عربي انجليزي.",
                "category"      => "سيرفرات",
                'link'          => "#",
                'linkCategory'  => "#"
            ],
        ]
    ]);
})->name('productesGet');
