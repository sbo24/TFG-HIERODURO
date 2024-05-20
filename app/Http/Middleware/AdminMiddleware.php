<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Verifica si el usuario está autenticado
        if (Auth::check()) {
            // Verifica si el usuario tiene permisos de administrador
            if (Auth::user()->is_admin == 1) {
                return $next($request);
            } else {
                // Si el usuario no tiene permisos, redirigir a una página de acceso denegado o inicio
                return redirect('/')->with('error', 'No tienes permisos para acceder a esta sección.');
            }
        }

        // Si el usuario no está autenticado, redirigir al login
        return redirect('/login');
    }
}
