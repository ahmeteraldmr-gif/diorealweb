<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  $permission
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, string $permission): Response
    {
        // 1. Env fallback user has all permissions
        if ($request->session()->get('is_admin') === true && !auth()->check()) {
            return $next($request);
        }

        // 2. Database user check
        if (auth()->check()) {
            $user = auth()->user();
            if ($user->hasPermission($permission)) {
                return $next($request);
            }
        }

        if ($request->expectsJson() || $request->is('api/*')) {
            return response()->json(['error' => 'Bu işlem için yetkiniz bulunmamaktadır.'], 403);
        }

        return redirect()->route('admin.dashboard')->withErrors([
            'permission_error' => 'Bu sayfaya erişmek için yetkiniz bulunmamaktadır.'
        ]);
    }
}
