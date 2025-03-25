<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class CheckAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                throw new UnauthorizedHttpException('JWT', 'User not authenticated');
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        return $next($request);
    }
}
