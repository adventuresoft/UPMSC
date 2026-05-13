<?php

use Illuminate\Support\Facades\Auth;

/**
 * Role ID Reference:
 * 1  = Admin (Superadmin)
 * 4  = Developer (Superadmin-equivalent)
 * 2  = DC
 * 3  = UNO
 * 6  = Union Admin       (Institutional Admin)
 * 8  = Pourashava Admin  (Institutional Admin)
 * 10 = City Corp Admin   (Institutional Admin)
 * 7  = Union User        (created by Union Admin)
 * 9  = Pourashava User   (created by Pourashava Admin)
 * 11 = City Corp User    (created by City Corp Admin)
 * 5  = User (generic)
 *
 * Permission naming convention: {module}.{action}
 * e.g. people.create, certificates.update, users.delete
 */

if (! function_exists('is_superadmin')) {
    function is_superadmin() {
        return Auth::check() && in_array(Auth::user()->role_id, [1, 4]);
    }
}

if (! function_exists('is_institutional_admin')) {
    function is_institutional_admin() {
        return Auth::check() && in_array(Auth::user()->role_id, [6, 8, 10]);
    }
}

if (! function_exists('basic_settings_permissions')) {
    function basic_settings_permissions() {
        return is_superadmin();
    }
}

if (! function_exists('institute_permissions')) {
    function institute_permissions() {
        return is_superadmin();
    }
}

if (! function_exists('access_management_permission')) {
    /**
     * Superadmins: full access management.
     * Institutional Admins: can manage their own sub-users only.
     */
    function access_management_permission() {
        return is_superadmin() || is_institutional_admin();
    }
}

/**
 * create_permission($module = null)
 *
 * If $module given, checks: superadmin OR has "{module}.create" Spatie permission.
 * Without $module, checks: superadmin OR institutional admin OR has ANY ".create" perm.
 *
 * Usage:
 *   @if(create_permission())             — generic create button
 *   @if(create_permission('people'))     — people-specific create
 *   @if(create_permission('certificates'))
 */
if (! function_exists('create_permission')) {
    function create_permission($module = null) {
        if (! Auth::check()) return false;
        if (is_superadmin()) return true;

        $user = Auth::user();
        if ($module) {
            return $user->hasPermissionTo($module . '.create');
        }
        // Generic: has any create permission
        return is_institutional_admin()
            || $user->getAllPermissions()->contains(fn($p) => str_ends_with($p->name, '.create'));
    }
}

/**
 * edit_permission($module = null)
 *
 * Controls whether edit/update buttons appear in any table.
 * If $module given, checks "{module}.update" Spatie permission.
 */
if (! function_exists('edit_permission')) {
    function edit_permission($module = null) {
        if (! Auth::check()) return false;
        if (is_superadmin()) return true;

        $user = Auth::user();
        if ($module) {
            return $user->hasPermissionTo($module . '.update');
        }
        // Generic: has any update permission
        return $user->getAllPermissions()->contains(fn($p) => str_ends_with($p->name, '.update'));
    }
}

/**
 * view_permission($module = null)
 *
 * Controls whether list/view buttons appear in tables.
 * If $module given, checks "{module}.read" Spatie permission.
 */
if (! function_exists('view_permission')) {
    function view_permission($module = null) {
        if (! Auth::check()) return false;
        if (is_superadmin()) return true;

        $user = Auth::user();
        if ($module) {
            return $user->hasPermissionTo($module . '.read');
        }
        // Generic: has any read permission
        return $user->getAllPermissions()->contains(fn($p) => str_ends_with($p->name, '.read'));
    }
}

/**
 * delete_permission($module = null)
 *
 * Controls whether delete buttons appear in tables.
 * If $module given, checks "{module}.delete" Spatie permission.
 */
if (! function_exists('delete_permission')) {
    function delete_permission($module = null) {
        if (! Auth::check()) return false;
        if (is_superadmin()) return true;

        $user = Auth::user();
        if ($module) {
            return $user->hasPermissionTo($module . '.delete');
        }
        // Generic: has any delete permission
        return $user->getAllPermissions()->contains(fn($p) => str_ends_with($p->name, '.delete'));
    }
}
