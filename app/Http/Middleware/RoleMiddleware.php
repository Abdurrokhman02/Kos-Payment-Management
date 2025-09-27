<?php

// app/Http/Middleware/RoleMiddleware.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if ($request->user()->role !== $role) {
            // Arahkan ke halaman lain (misalnya dashboard biasa atau halaman 403 Forbidden)
            abort(403, 'Akses Ditolak: Anda tidak memiliki peran yang sesuai.'); 
        }

        return $next($request);
    }
}