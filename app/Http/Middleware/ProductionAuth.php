<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ProductionAuth
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
        switch (Auth::user()->role_id) {
            case 6:
                return $next($request);
            case 2:
                return $next($request);
            case 1:
                return $next($request);
            default:
                return Redirect::route('home')
                    ->with(['status' => 'Anda tidak punya akses disini.']);
        }
    }
}
