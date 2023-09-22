<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsVerifyEmail
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::user()->is_email_verified) {
            auth()->logout();
            return redirect()->route('get.login')
                    ->with('message', 'تحتاج إلى تأكيد حسابك. لقد أرسلنا لك رمز التفعيل، يرجى التحقق من بريدك الإلكتروني');
          }
        return $next($request);
    }
}
