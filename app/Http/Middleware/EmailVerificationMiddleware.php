<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class EmailVerificationMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = User::find(!empty(auth()->user()) ? auth()->user()->id : '' );

        if (empty($user->email_verified_at))
        {
            return redirect(route('user.login'));
        }

        return $next($request);
    }
}
