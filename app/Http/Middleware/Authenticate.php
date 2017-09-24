<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use App\User;
use Auth;
use Request;

class Authenticate
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->auth->guest())
        {
            if ($request->ajax())
            {
                return response('Unauthorized.', 401);
            }
            else
            {
                return redirect()->route('login_page');
            }
        }

        // Redirect if password reset
        if(Auth::user()->reset == 1)
        {
            if(in_array(Request::segment(3), ['password-edit', 'password-update']) || in_array(Request::segment(2), ['logout']))
            {
                return $next($request);
            }
            return redirect()->route('user_password_edit');
        }

        #echo 'will redirect!'; exit;
        return $next($request);
    }
}
