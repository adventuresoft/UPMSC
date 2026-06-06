<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AdminMiddleware
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
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // 1. Superadmins (Admin = 1, Developer = 4) always have full access
        if (in_array($user->role_id, [1, 4])) {
            return $next($request);
        }

        // 2. Perform granular checking for basic settings routes
        $routeName = $request->route() ? $request->route()->getName() : null;

        if ($routeName && str_starts_with($routeName, 'basic-settings.')) {
            $parts = explode('.', $routeName);
            if (count($parts) >= 2) {
                // Map route name to Spatie permission name (convert hyphens to underscores)
                $module = str_replace('-', '_', $parts[1]);
                $action = $parts[2] ?? 'index';

                // Map route action to specific permission check
                if (in_array($action, ['create', 'store'])) {
                    if (create_permission($module)) {
                        return $next($request);
                    }
                } elseif (in_array($action, ['edit', 'update'])) {
                    if (edit_permission($module)) {
                        return $next($request);
                    }
                } elseif (in_array($action, ['destroy'])) {
                    if (delete_permission($module)) {
                        return $next($request);
                    }
                } else {
                    // Default to read/view permission for index, show, etc.
                    if (view_permission($module)) {
                        return $next($request);
                    }
                }
            }
        }

        // 3. Fallback to general basic-settings permission
        if ($user->can('basic-settings.read')) {
            return $next($request);
        }

        return redirect()->back();
    }
}
