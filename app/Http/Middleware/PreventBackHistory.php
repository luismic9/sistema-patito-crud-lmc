<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Closure;

class PreventBackHistory
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * 
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        
        if ($response instanceof \Inertia\Response || 
            $response instanceof \Illuminate\Http\Response ||
            $response instanceof \Illuminate\Http\RedirectResponse) {
            
            $response->header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate')
                     ->header('Pragma', 'no-cache')
                     ->header('Expires', 'Sat, 01 Jan 1990 00:00:00 GMT');
        }
        
        return $response;
    }
}
