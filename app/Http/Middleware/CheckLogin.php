<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Session;
use Closure;
class CheckLogin
{

    public function handle($request, Closure $next)
    {
        if (empty(Session::get('_uid'))) {
            return redirect('/login');
        }
        return $next($request);
    }

}