<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * Maps route names to Spatie permission checks.
     * Superadmins (role_id 1 or 4) always pass through.
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

        $routeName = $request->route() ? $request->route()->getName() : null;

        if (!$routeName) {
            return $next($request);
        }

        // 2. Map route name to (module, action) pair
        [$module, $action] = $this->resolvePermission($routeName);

        // 3. If no module could be resolved, allow the request through
        if (!$module) {
            return $next($request);
        }

        // 4. Build the Spatie permission name and check it
        $permissionName = $module . '.' . $action;

        try {
            if ($user->hasPermissionTo($permissionName)) {
                return $next($request);
            }
        } catch (\Exception $e) {
            // Permission doesn't exist in DB — allow superadmins (already handled above)
            // For regular users, deny access
        }

        // 5. Deny — redirect back with error
        session()->flash('error', 'You do not have permission to access this resource.');
        return redirect()->back();
    }

    /**
     * Resolve a route name to [module, action] for Spatie permission check.
     *
     * Returns [null, null] if the route should not be checked.
     */
    private function resolvePermission(string $routeName): array
    {
        // Map route action suffixes to Spatie actions
        $actionMap = [
            'index'    => 'read',
            'show'     => 'read',
            'create'   => 'create',
            'store'    => 'create',
            'edit'     => 'update',
            'update'   => 'update',
            'destroy'  => 'delete',
            // Certificate-specific actions (all are read)
            'bn_certificate'    => 'read',
            'certificate'       => 'read',
            'invoice'           => 'read',
            'preview'           => 'read',
            'confirmedLicense'  => 'read',
            'confirmation'      => 'update',
            'getTradeLicense'   => 'read',
            // Special actions
            'approve'           => 'update',
            'approved_index'    => 'read',
            'approvedlist'      => 'read',
            'searchPeoplePage'  => 'read',
            // Village court specific
            'court_formed_list' => 'read',
            'hearing_list'      => 'read',
            'verdict_list'      => 'read',
            'form-court'        => 'update',
            'form-court.view'   => 'read',
            'hearing'           => 'update',
            'hearing.view'      => 'read',
            'verdict'           => 'update',
            'verdict.view'      => 'read',
            // organization transfer
            'incoming'          => 'read',
            'store'             => 'create',
            'reject'            => 'update',
            // vehicle specific
            'approval.list'     => 'read',
            'invoice.list'      => 'read',
            'license.list'      => 'read',
            'fees.vehicle'      => 'create',
            'fees.list'         => 'read',
            // people specific
            'reveal'            => 'read',
            'toggle-status'     => 'update',
            'reset'             => 'update',
        ];

        // Route-prefix to permission-module mapping
        $moduleMap = [
            // Dashboard
            'dashboard'                         => 'dashboard',

            // People
            'people'                            => 'people',
            'peoples.credentials'               => 'people_credentials',
            'peoples.credentials.reveal'        => 'people_credentials',
            'peoples.credentials.toggle'        => 'people_credentials',
            'peoples.credentials.reset'         => 'people_credentials',
            'peopleapprovedlist'                => 'people',
            'peoplesearch'                      => 'people',
            'people.approve'                    => 'people',

            // Certificates — all use 'certificate' module
            'citizen'                           => 'certificate',
            'character'                         => 'certificate',
            'death'                             => 'certificate',
            'succession'                        => 'certificate',
            'inheritance'                       => 'certificate',
            'birth'                             => 'certificate',
            'unmarried'                         => 'certificate',
            'married'                           => 'certificate',
            'remarried'                         => 'certificate',
            'landless'                          => 'certificate',
            'name'                              => 'certificate',
            'income'                            => 'certificate',
            'disability-certificate'            => 'certificate',
            'voter-area'                        => 'certificate',
            'voter-list'                        => 'certificate',
            'nid-correction'                    => 'certificate',
            'childless'                         => 'certificate',
            'orphan'                            => 'certificate',
            'financial-instability'             => 'certificate',
            'age'                               => 'certificate',
            'permanent-citizen'                 => 'certificate',
            'residential'                       => 'certificate',
            'guardian-income'                   => 'certificate',
            'guardian-acceptance'               => 'certificate',
            'birth-registration-correction'     => 'certificate',
            'new-voter-recommendation'          => 'certificate',
            'voter-registration-agreement'      => 'certificate',
            'not-rohingya'                      => 'certificate',
            'passport-related'                  => 'certificate',
            'family'                            => 'certificate',
            'alive'                             => 'certificate',
            'missing-person'                    => 'certificate',
            'abandoned-by-husband'              => 'certificate',
            'widow'                             => 'certificate',
            'dependency'                        => 'certificate',
            'dowryless'                         => 'certificate',
            'unemployment'                      => 'certificate',
            'helplessness'                      => 'certificate',
            'illiteracy'                        => 'certificate',
            'agriculture'                       => 'certificate',
            'fisherman'                         => 'certificate',
            'professional'                      => 'certificate',
            'farmer-fuel-oil-card'              => 'certificate',
            'no-objection'                      => 'certificate',
            'general'                           => 'certificate',
            'infrastructure-construction-permission' => 'certificate',
            'power-of-attorney'                 => 'certificate',
            'ethnic-minority'                   => 'certificate',
            'tribal'                            => 'certificate',
            'indigenous'                        => 'certificate',

            // Organization
            'organization'                      => 'organization',
            'orgapproved_index'                 => 'organization',
            'organization.approve'              => 'organization',
            'organization.transfer'             => 'organization_transfer',

            // Trade License
            'organizationA.trade-license'       => 'trade_license',
            'organizationA.registration-fees'   => 'organization',
            'organizationA.renew-fees'          => 'organization',

            // House
            'house'                             => 'house',

            // Land
            'land'                              => 'land',

            // Vehicle
            'vehicle'                           => 'vehicle',

            // Road
            'road'                              => 'road',

            // Tax
            'tax'                               => 'tax',
            'taxes'                             => 'tax',

            // Marriage & Divorce
            'marriage'                          => 'marriage',
            'divorce'                           => 'divorce',

            // Chairman & Councilor
            'chairman'                          => 'chairman',
            'councilor'                         => 'councilor',

            // Village Court
            'village-court'                     => 'village_court',

            // Relief Card
            'relief-card'                       => 'relief_card',

            // Market
            'market'                            => 'market',

            // Institute
            'institute'                         => 'institute',
            'institutional-admin'               => 'institutional-admin',

            // User Management
            'user'                              => 'user',
            'role'                              => 'role',
            'permission'                        => 'permission',
            'rolepermission'                    => 'role',
            'roleuser'                          => 'user',
            'userper'                           => 'user',

            // Basic settings (already handled below)
            'basic-settings'                    => 'basic-settings',
        ];

        // Handle basic-settings routes separately (granular per-module)
        if (str_starts_with($routeName, 'basic-settings.')) {
            $parts = explode('.', $routeName);
            if (count($parts) >= 2) {
                $subModule = str_replace('-', '_', $parts[1]);
                $routeAction = $parts[2] ?? 'index';
                $action = $this->mapRouteActionToPermissionAction($routeAction, $actionMap);
                return [$subModule, $action];
            }
        }

        // Try matching the route name against the module map
        // First try exact match
        if (isset($moduleMap[$routeName])) {
            $module = $moduleMap[$routeName];
            // Extract the last segment as the action
            $parts = explode('.', $routeName);
            $lastSegment = end($parts);
            $action = $this->mapRouteActionToPermissionAction($lastSegment, $actionMap);
            return [$module, $action];
        }

        // Try prefix match — walk from longest prefix to shortest
        $parts = explode('.', $routeName);
        for ($i = count($parts); $i >= 1; $i--) {
            $prefix = implode('.', array_slice($parts, 0, $i));
            if (isset($moduleMap[$prefix])) {
                $module = $moduleMap[$prefix];
                $lastSegment = $parts[count($parts) - 1];
                $action = $this->mapRouteActionToPermissionAction($lastSegment, $actionMap);
                return [$module, $action];
            }
        }

        // No match found — allow through (non-protected route)
        return [null, null];
    }

    /**
     * Convert a route action string to a Spatie permission action.
     */
    private function mapRouteActionToPermissionAction(string $routeAction, array $actionMap): string
    {
        if (isset($actionMap[$routeAction])) {
            return $actionMap[$routeAction];
        }

        // Default fallback
        return 'read';
    }
}
