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

        // Detect subdomain like demo.insighthq.com
        if (preg_match('/^([a-z0-9-]+)\.insighthq\.com$/', $host, $matches)) {
            $subdomain = $matches[1];
            // List of public paths allowed for subdomains
            $allowedPaths = [
                'coming-soon',
                'announcementlist',
                'announcementlist/*',
            ];
            // Check if current path is allowed
            foreach ($allowedPaths as $allowed) {
                if ($request->is($allowed)) {
                    return $next($request);
                }
            }

            // Not an allowed path → 404
            abort(404, 'Page not available');
        }

        // Continue normally for main domain
        return $next($request);
    }
}
