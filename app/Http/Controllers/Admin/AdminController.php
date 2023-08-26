<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function getLogin()
    {
        return view('pages.dashboard.Admin.login');
    }

    public function postLogin(LoginRequest $r)
    {
        $remember_me = $r->has('save') ? true : false;
        if (auth()->attempt(['email' => $r->email, 'password' => $r->password], $remember_me)) {
            if (auth()->user()->role_id == 1) {
                return redirect()->route('dashboard');
            } else {
                auth()->logout();

                return redirect()->route('get.login')->with('error', 'غير مصرح لك بالدخول');
            }
        } else {
            return redirect()->route('getAdminLogin')->with('error', 'معلومات التسجيل خاطئة الرجاء إعادة المحاولة');
        }
    }
}
