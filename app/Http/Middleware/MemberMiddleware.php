<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MemberMiddleware
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
            if ($user && $user->role === 'member')
                return $next($request);
            return back()->with('error', 'لا يمكنك الوصل لهذه الصفحة. يرجى الدخول بحساب عضو لدخول الصفحة.');
        } catch (\Throwable $th) {
            return back()->with('error', ' حصل خطأ يرجى تسجيل الدخول');
        }
    }
}
