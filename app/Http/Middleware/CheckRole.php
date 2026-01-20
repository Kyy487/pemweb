<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  ...$roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Check if user is authenticated
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // Check if user has one of the required roles
        if (in_array(auth()->user()->role, $roles)) {
            return $next($request);
        }

        // Redirect to appropriate dashboard based on user role
        $userRole = auth()->user()->role;
        
        if ($userRole === 'admin') {
            return redirect('/admin/dashboard')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        } elseif ($userRole === 'teacher') {
            return redirect('/teacher/dashboard')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        } elseif ($userRole === 'student') {
            return redirect('/student/dashboard')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
    }
}
