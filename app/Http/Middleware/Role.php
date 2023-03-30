<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class Role
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */

    public function handle($request, Closure $next, ...$roles)
    {
        if (!Auth::check())
            return redirect('login')->with('status', 'Silahkan Login Terlebih Dahulu');
        $user = Auth::user();
        if ($user->role) {
            if ($user->role == $roles[0])
                return $next($request);
        }
        return redirect('login')->with('status', 'Silahkan Login Terlebih Dahulu');
    }
}
