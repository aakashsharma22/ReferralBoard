<?php


namespace App\Http\Middleware;


use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle($request, \Closure $next)
    {
        if (Auth::user()->getIsAdmin()) {
            return $next($request);
        }

        return redirect()->route('/home'); // If user is not an admin.
    }
}
