<?php

namespace App\Http\Middleware;

use Closure;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!\Auth::guest() && \Auth::user()->role == 'admin') {
            return $next($request);
        } else {
            return redirect(route('admin.Login'))->with('error', 'Forbidden 403');
        }

        return redirect(route('admin.Login'));
    }
}
