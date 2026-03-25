<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, ...$roles)
    {
        // Si el usuario no está logueado o su rol no está en la lista permitida, lo mandamos al login
        if (!auth()->check() || !in_array(auth()->user()->rol, $roles)) {
            return redirect('login')->with('error', 'No tienes permisos para acceder aquí.');
        }
        return $next($request);
    }
}
