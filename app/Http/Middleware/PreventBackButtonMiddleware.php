<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;

class PreventBackButtonMiddleware
{
    public function handle($request, Closure $next)
    {
        $user = User::find(auth()->user()->id);

        if (auth()->user() == null)
        {
            return redirect(route('user.login'));
        }
        elseif (empty($user->email_verified_at))
        {
            return redirect(route('user.login'));
        }

        return $next($request);
    }
}
