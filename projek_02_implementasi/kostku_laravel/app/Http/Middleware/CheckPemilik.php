<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPemilik
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->user()->isPemilik() && !auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized - Hanya Pemilik atau Admin yang dapat mengakses halaman ini.');
        }

        return $next($request);
    }
}
