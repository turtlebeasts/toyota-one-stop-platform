<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
            if (auth()->user()->type == 3) {
                return $next($request);
            } else {
                return response()->json(['error' => 'unauthorized access'], Response::HTTP_UNAUTHORIZED);
            }
        } else {
            return redirect('/')->with('error', 'You must be logged in first!');
        }
    }
}
