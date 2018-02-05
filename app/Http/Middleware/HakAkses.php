<?php

namespace App\Http\Middleware;

use Closure;
use App;
use Auth;
class HakAkses
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$level)
    {
        if(\Auth::user() && \Auth::user()->user_role !== $level){
               // return App::abort(Auth::check() ? 403 : 401, Auth::check() ? 'Forbidden : unathorized!');
            return "Forbidden";
        }
        return $next($request);
    }
}
