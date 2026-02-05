<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Revisa si el usuario inició sesión
        // 2. Revisa si tiene la función isAdmin() que pusimos en User.php
        if (auth()->check() && auth()->user()->isAdmin()) {
            return $next($request);
        }

        // Si no es admin, lo regresa a la página principal con un mensaje
        return redirect('/')->with('error', 'No tienes permisos de administrador.');
    }
}