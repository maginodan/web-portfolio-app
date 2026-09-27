<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class DemoModeMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (config('app.demo')) {

            if (in_array($request->method(), ['POST', 'PUT', 'PATCH', 'DELETE'])) {

                if ($request->expectsJson()) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Demo mode: You cannot modify data in demo mode.'
                    ], 403);
                }

                return redirect()->back()->with('info', 'Demo mode: You cannot modify data in demo mode.');
            }
        }

        return $next($request);
    }
}