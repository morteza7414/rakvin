<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->user()->role !== 'user') {
            abort(403, 'شما دسترسی لازم برای ورود به این صفحه را ندارید!');
        }
        return $next($request);
    }
}
