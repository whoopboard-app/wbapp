<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TenantMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $tenant = $request->route('tenant');

        if (!Auth::check()) {
            return redirect()->route('login');
        }
        if (Auth::user()->tenant->custom_url !== $tenant) {
            abort(403, 'Unauthorized tenant access.');
        }

        return $next($request);
    }
}
