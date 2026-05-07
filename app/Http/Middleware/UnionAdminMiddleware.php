<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UnionAdminMiddleware
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
        $allowedRoles = [1, 4, 6]; // 1 = Super Admin, 4 = Admin, 6 = Union Admin
        if (Auth::check() && in_array(Auth::user()->role_id, $allowedRoles)) {
            return $next($request);
        } else {
            return redirect()->back()->with('error', 'Unauthorized. You do not have permission to perform this action.');
        }
    }
}
