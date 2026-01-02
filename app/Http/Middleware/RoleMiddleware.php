<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!Auth::check() || Auth::user()->role !== $role) {
            // Jika user tidak login atau role tidak sesuai
            abort(403, 'Akses ditolak. Anda tidak memiliki izin yang sesuai.');
        }

        return $next($request);
    }
}