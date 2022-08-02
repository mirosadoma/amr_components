<?php

namespace Amr\AmrComponents\Middlewares;

use Closure;
use Illuminate\Http\Request;

class MaintenanceMiddleware
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
        if(layout_data()->config && layout_data()->config->close == 1){
            return redirect()->route('maintenance');
        }
        return $next($request);
    }
}
