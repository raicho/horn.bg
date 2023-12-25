<?php

namespace User\Middlewares;

use Closure;
use Illuminate\Support\Facades\Auth;
class GhostMiddleware
{
    /**
     * Run the request filter.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // check for logged user //
        if(Auth::user()) {
            return redirect()->route('user_home');
        }
        return $next($request);
    }
}
