<?php

namespace App\Http\Middleware;

use App\Enums\UserRole;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (
            Auth::check() &&
            (Auth::user()->role == UserRole::Administrator
                || Auth::user()->role == UserRole::Recruiter
                || Auth::user()->role == UserRole::SubAdmin)
        ) {
            return $next($request);
        } else {
            return redirect()->route('admin.login');
        }
    }
}
