<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RestrictSubdomainAccess
{
    public function handle(Request $request, Closure $next): Response
    {
        $host = $request->getHost();
        $mainDomain = preg_replace('/^.*?([^.]+\.[^.]+)$/', '$1', $host);
        if (preg_match('/^([a-z0-9-]+)\.' . preg_quote($mainDomain, '/') . '$/i', $host, $matches)) {
            $subdomain = $matches[1];
            $allowedPaths = [
                'coming-soon',
                'announcementlist',
                'announcementlist/*',
            ];

            foreach ($allowedPaths as $allowed) {
                if ($request->is($allowed) || $request->is($allowed.'/*')) {
                    return $next($request);
                }
            }

            abort(404, 'Page not available');
        }

        return $next($request);
    }

}
