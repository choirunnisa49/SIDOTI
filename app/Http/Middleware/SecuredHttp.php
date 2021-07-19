<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SecuredHttp
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
        if (!$request->secure()) {
            return redirect()->secure($request->path());
        }
        
        return $next($request);
    }
}
