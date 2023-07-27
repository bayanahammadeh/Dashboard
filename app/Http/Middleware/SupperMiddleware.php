<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupperMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            if (Auth::user()->role_as == 1) {
                return $next($request);
            }
            if (Auth::user()->role_as == 2) {
                return redirect('admin/user');
            }
            if (Auth::user()->role_as == 3) {
                return redirect('user/personal');
            }
        } else {
            return redirect('/');
        }
    }
}
