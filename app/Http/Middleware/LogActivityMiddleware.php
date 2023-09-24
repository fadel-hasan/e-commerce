<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LogActivityMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $subject): Response
    {

        if(auth()->check())
        {
            \LogActivity::addToLog(
                $subject,
                (auth()->id() ?? null)
            );
            $response = $next($request);
        }

        else
         {
            $response = $next($request);
            \LogActivity::addToLog(
                $subject,
                (auth()->id() ?? null)
            );
        }
        return $response;
    }
}
