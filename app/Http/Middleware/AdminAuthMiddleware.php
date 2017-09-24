<?php

namespace App\Http\Middleware;
use Redirect;
use Auth;

use Closure;

class AdminAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::user()->access != 1)
        {

            return Redirect::back();
        }

        return $next($request);
    }
}
