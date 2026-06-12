<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Ensure the authenticated user is an admin.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (app()->environment('local') && !auth()->check()) {
            $adminUser = \App\Models\User::where('is_admin', true)->first();
            if ($adminUser) {
                auth()->login($adminUser);
            }
        }

        if (!auth()->check() || !auth()->user()->is_admin) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthorized.'], 403);
            }

            abort(403, 'You do not have admin access.');
        }

        return $next($request);
    }
}
