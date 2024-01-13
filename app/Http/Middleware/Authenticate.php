<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    // public function handle(Request $request, Closure $next): Response
    // {
    //     return  $request->user() ? $next($request) : back()->with("error", "يرجى تسجيل الدخول لإتمام العملية.");
    // }

    protected function redirectTo(Request $request): ?string
    {
 
        return $request->expectsJson() ? null : route('login');
    }
}
