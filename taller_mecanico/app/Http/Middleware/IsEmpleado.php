<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IsEmpleado
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->rol === 'empleado') {
            return $next($request);
        }

        return redirect('/login')->with('error', 'Acceso no autorizado.');
    }
}
