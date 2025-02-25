<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && auth()->user()->rol == "admin") {
            return $next($request);
        }

        return redirect()->route('explotaciones');  // Redirige a otro lugar si no es admin
    }

}
