<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$guards): Response
    {
        foreach ($guards as $guard) {
            if(Auth::guard($guard)->check()) {
                $user = Auth::user();
                if($user->user_role === 'admin') {
                    return redirect()->route('dashboard');
                } else {
                    return redirect()->route('dashboard');
                }
            }
        }
        
        return $next($request);
    }

    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('/'); // ganti 'home' sesuai nama route halaman utama kamu
        }
    }
}
