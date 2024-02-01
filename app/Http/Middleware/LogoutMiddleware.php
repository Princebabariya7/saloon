<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LogoutMiddleware
{
    public function handle(Request $request, Closure $next)
    {

        if (auth()->user() == null)
        {
            return redirect(route('admin.sign_in'));
        }

        if (auth()->user()->user_status != "admin")
        {
            return redirect()->route('home');
        }
        return $next($request);

    }
}
