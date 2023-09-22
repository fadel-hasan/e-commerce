<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckIfAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $admin = DB::table('roles')->where('name', 'admin')->value('id');
        if (Auth::check() && Auth::user()->role_id == $admin) {
            return $next($request);
        }
        return redirect(route('get.login'))->with('error', 'الرجاء تسجيل الدخول اولا');
    }
}
