<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Role
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        // cek role user sesuai parameter
        if (Auth::user()->role !== $role) {
            abort(403, 'Anda tidak punya akses.');
        }

        return $next($request);
    }
}
