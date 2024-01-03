<?php
namespace Admin\Middlewares;


use Illuminate\Session\Middleware\StartSession;
use Closure;
use Illuminate\Support\Facades\Auth;
class AdminMiddleware
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
        if(!Auth::user() || Auth::user()->is_admin != 1) {
            return redirect()->route('login_page');
        }
        return $next($request);
    }
}
