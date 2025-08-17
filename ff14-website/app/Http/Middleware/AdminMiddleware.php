<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    // controleer of gebruiker admin is
    public function handle(Request $request, Closure $next): Response
    {
        // check of gebruiker is ingelogd en admin is
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            abort(403, 'Je hebt geen toegang tot deze pagina.');
        }

        return $next($request);
    }
}
