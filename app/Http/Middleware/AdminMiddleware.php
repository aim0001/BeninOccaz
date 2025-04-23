<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (auth()->check() && auth()->user()->user_type == 'admin') {
            return $next($request);
        }

        return redirect('/')->with('error', 'Accès non autorisé');
    }
}
