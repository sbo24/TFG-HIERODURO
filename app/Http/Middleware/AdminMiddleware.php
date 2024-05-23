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
        if (Auth::check() && Auth::user()->is_admin == 1) {
            return $next($request);
        }

        // Si el usuario no es un administrador, redirigir o devolver una respuesta de error
        if ($request->expectsJson()) {
            return response()->json(['error' => 'No tienes permisos para acceder a esta área.'], 403);
        } else {
            return redirect()->route('index')->with('error_message', 'No tienes permisos para acceder a esta área.');
        }
    }
}
