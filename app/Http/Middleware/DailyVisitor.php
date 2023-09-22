<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Visitor;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;

class DailyVisitor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // dd();

        if (!$request->cookie('visit_' . date('Y-m-d'))) {
            Visitor::updateOrCreate(
                ['date' => date('Y-m-d')],
                ['count' => Visitor::where('date', date('Y-m-d'))->value('count') + 1]
            );
            $cookieExpiration = Carbon::tomorrow()->diffInMinutes();

            Cookie::queue(Cookie::make('visit_' . date('Y-m-d'), 'visit', $cookieExpiration, '/', null, true, true));
        }
        return $next($request);
    }
}
