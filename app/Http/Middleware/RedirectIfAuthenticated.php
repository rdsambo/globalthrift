<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
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
        if (Auth::guard($guard)->check()) {
            $user = Auth::guard($guard)->user();
            if($user->role =="admin"){

                   return redirect(route("admin.index"));
            }
            if($user->role == "user"){
                //dd("Users");
                return redirect(route("user.index"));

            }
            if ($user->role == "operator") {
                //dd("Users");
                return redirect(route("operator.index"));
            }
            return redirect(RouteServiceProvider::HOME);
        }
        return $next($request);
    }
}
