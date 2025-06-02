<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class EnsureTokenIsValid
{
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json(['message' => 'Authorization token not found'], 401);
        }

        try {
            $decoded = JWT::decode($token, new Key(env('JWT_SECRET'), 'HS256'));

            if (isset($decoded->exp) && $decoded->exp < time()) {
                return response()->json(['message' => 'Token has expired'], 401);
            }

            $request->attributes->add(['user' => $decoded]);

            return $next($request);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Invalid token',
                'error' => $e->getMessage()
            ], 401);
        }
    }
}
