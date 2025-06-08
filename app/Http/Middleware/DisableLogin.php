<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class DisableLogin
{
    /**
     * Check if user can login.
     *
     * $middleware->append(DisableLogin::class);
     * ->middleware(DisableLogin::class);
     * ->withoutMiddleware([DisableLogin::class]);
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user()->can('disable_login')) {
            Auth::logout();

            return response()->json([
                'message' => __('login.allow_login_banned'),
                'user' => null,
                'redirect' => '/ban/login',
                'guard' => 'web',
            ]);
        }

        return $next($request);
    }
}
