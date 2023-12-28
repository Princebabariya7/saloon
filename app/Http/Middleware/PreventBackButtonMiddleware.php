<?php

namespace App\Http\Middleware;

use Closure;

class PreventBackButtonMiddleware
{
    public function handle($request, Closure $next)
    {

        if (auth()->user() == null)
        {
            return redirect(route('user.login'));
        }
        return $next($request);
    }

}
