<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

class CheckTokenExpiration
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->user()->currentAccessToken();

        if ($token && $token->expires_at && Carbon::now()->gt($token->expires_at)) {
            return response()->json(['error' => 'Token expired'], 401);
        }

        return $next($request);
    }
}
