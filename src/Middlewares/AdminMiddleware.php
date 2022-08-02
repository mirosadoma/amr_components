<?php

namespace Amr\AmrComponents\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!Auth::guard('admin')->check()){
            return redirect()->route('login');
        }
        if (Auth::guard('admin')->check() && Auth::guard('admin')->user()->is_active != 1) {
            Auth::guard('admin')->logout();
            return redirect()->route('login')->with('error', __("You Are Not Active From Administrator"));
        }
        // if (count(Auth::guard('admin')->user()->getPermissionsViaRoles()) == 0) {
        //     return redirect()->route('home')->with('error' , __('You do not have access to the link'));
        // }
        if (Auth::guard('admin')->check() && Auth::guard('admin')->user()->type == "client")
        {
            Auth::guard('admin')->logout();
            return redirect()->route('home');
        }
        return $next($request);
    }
}
