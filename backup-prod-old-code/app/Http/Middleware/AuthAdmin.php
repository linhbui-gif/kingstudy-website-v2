<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

use App\Helpers\Auth as HAuth;

class AuthAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $user = HAuth::getUserInfo();
        if (HAuth::is_admin($user) || $user->user_type == 1) {
            return $next($request);
        }
        return redirect('/');
    }
}
