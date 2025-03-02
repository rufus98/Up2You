<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Config;

class RouteSecureMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $apiKey = env('API_KEY');
        
        // Verifica che la chiave API sia presente nelle intestazioni della richiesta
        if ($request->header('X-API-KEY') !== $apiKey) {
            return response()->json(['error' => 'Unauthorized'], 401); // Risposta di errore se la chiave non corrisponde
        }

        return $next($request);
    }
}
