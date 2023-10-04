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
    public function handle(Request $request, Closure $next ,$name): Response
    {

        $admin_id = cache()->remember('admin_role_id', 60 *60 *24, function () use ($name) {
        return DB::table('roles')->where('name', $name)->value('id');
    });
    if (Auth::check() && Auth::user()->role_id == $admin_id) {
        return $next($request);
    }
    return redirect(route('get.login'))->with('error', 'الرجاء تسجيل الدخول اولا');
    }
}
