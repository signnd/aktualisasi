<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    /**
     * Ensure the authenticated user has the given role.
     *
     * Accepts either a user model with a `hasRole()` method (e.g. spatie) or a
     * simple string `role` attribute on the user model.
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $user = $request->user();

        if (! $user) {
            abort(403);
        }

        if (method_exists($user, 'hasRole')) {
            if (! $user->hasRole($role)) {
                abort(403);
            }

            return $next($request);
        }

        if (isset($user->role) && $user->role === $role) {
            return $next($request);
        }

        abort(403);
    }
}
