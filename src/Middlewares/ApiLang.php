<?php

namespace Amr\AmrComponents\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Auth;

class ApiLang
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
        $locale = request()->header('Api-Lang');
        if($locale){
            app()->setLocale($locale);
        }else{
            app()->setLocale('en');
        }
        return $next($request);
    }
}
