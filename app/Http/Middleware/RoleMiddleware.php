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
        if (!Auth::check()) {
            abort(403);
        }

        $user = Auth::user();

        if ($user->role !== $role) {
            abort(403, 'Unauthorized');
        }

        if ($role === 'hod') {

            if (!$user->hod) {
                Auth::logout();
                abort(403, 'HoD profile not found.');
            }

            if (!$user->hod->is_active) {
                Auth::logout();
                abort(403, 'Your HoD account has been terminated.');
            }
        }

        return $next($request);
    }
}

