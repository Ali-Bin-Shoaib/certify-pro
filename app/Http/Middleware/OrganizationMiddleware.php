<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OrganizationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $user = $request->user();
            if (!$user)
                return redirect()->route('login');
            if ($user && $user->role === 'organization') {
                return $next($request);
            }
            return back()->with('error', 'لا يمكنك الوصل لهذه الصفحة. يرجى الدخول بحساب منظمة لدخول الصفحة.');
        } catch (\Throwable $th) {
            return back()->with('error', ' حصل خطأ يرجى تسجيل الدخول');
        }
    }
}
