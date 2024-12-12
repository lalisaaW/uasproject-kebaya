<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class authmiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (!Auth::check()) {
            Log::warning('Unauthorized access attempt');
            return redirect()->route('login');
        }
    
        Log::info('Authenticated user: ' . Auth::user()->email);
        return $next($request);
    
        $role = Auth::user()->role->nama_role;
    
        // Kondisi berdasarkan role
        if ($role === 'Admin' || $role === 'Penjual' || $role === 'Pembeli') {
            return $next($request);
        }
    
        // Jika role tidak diizinkan
        return redirect()->route('login')->withErrors(['error' => 'Unauthorized role']);
        // return $next($request);
    }
}
