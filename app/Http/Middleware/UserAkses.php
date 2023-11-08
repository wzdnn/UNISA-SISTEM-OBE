<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserAkses
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$role): Response
    {
        // if(auth()->user()->role == $role) {
        //     return $next($request);

        // }

        // cek user sudah login(auth)
        if (!$request->user() || !Auth::user()) {
            abort(403, "Perlu Login");
        } else if (!in_array(Auth::user()->role, $role)) {
            abort(403, "Akses ditolak");
        }

        return $next($request);
    }
}
