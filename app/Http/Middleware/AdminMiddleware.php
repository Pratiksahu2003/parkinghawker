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
        if (!auth()->check()) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthorized.'], 401);
            }

            return redirect()->route('login');
        }

        $user = auth()->user();

        // Enforce admin check (either is_admin flag or Spatie admin role)
        if (!$user->is_admin && !$user->hasRole('admin')) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'You do not have admin access.'], 403);
            }

            abort(403, 'You do not have admin access.');
        }

        return $next($request);
    }
}
