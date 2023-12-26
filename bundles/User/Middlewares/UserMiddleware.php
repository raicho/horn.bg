<?php

namespace User\Middlewares;
use Illuminate\Session\Middleware\StartSession;
use Closure;
use Illuminate\Support\Facades\Auth;
class UserMiddleware
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
        if(!Auth::user()) {
            return redirect()->route('login_page');
        }
        return $next($request);
    }
}
