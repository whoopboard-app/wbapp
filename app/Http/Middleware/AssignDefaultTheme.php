<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AssignDefaultTheme
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! session()->has('theme')) {
            session(['theme' => 'light']);
        }

        return $next($request);
    }
}
