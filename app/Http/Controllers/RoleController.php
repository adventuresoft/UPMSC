<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct() {
        // Restrict role management to superadmins only
    }

    private function guardSuperadmin() {
        if (!is_superadmin()) {
            abort(403, 'Only Superadmins can manage Roles.');
        }
    }
    
    public function index()
    {
        $this->guardSuperadmin();
        $roles = Role::with('permissions')->paginate(10);
        $permissions = Permission::all();
        
        $basicSettingsModules = [
            'city_corporation', 'city_corporation_ward', 'city-corporation', 'city-corporation-ward',
            'family_category', 'family_subcategory', 'family_type',
            'house_category', 'house_ownership_type', 'house_type', 'house_class', 'house_owner_type',
            'land_class', 'land_ownership_type', 'land_type',
            'organization_category', 'organization_subcategory', 'organization_type', 'organization_work_area', 'organization_class', 'organization_owenership_type', 'organization_ownership_type',
            'profession', 'profession_category', 'profession_subcategory', 'profession_type',
            'road_category', 'road_owner', 'road_type',
            'union', 'union_ward',
            'vehicle_category', 'vehicle_subcategory', 'vehicle_type',
            'village', 'village_area',
            'reserve_ward', 'reserve-ward',
            'market', 'market_category', 'market_ownership_type', 'market_type',
            'bank', 'account_type', 'country',
            'basic-settings', 'basic_settings'
        ];

        $instituteSettingsModules = [
            'institute', 'institute_category', 'institute_type',
        ];

        $permissionGroups = $permissions->filter(function($permission) use ($basicSettingsModules, $instituteSettingsModules) {
            $parts = explode('.', $permission->name);
            $module = count($parts) > 1 ? $parts[0] : 'Others';
            return !in_array($module, $basicSettingsModules) && !in_array($module, $instituteSettingsModules);
        })->groupBy(function($permission) {
            $parts = explode('.', $permission->name);
            return count($parts) > 1 ? $parts[0] : 'Others';
        });

        $basicSettingsGroups = $permissions->filter(function($permission) use ($basicSettingsModules) {
            $parts = explode('.', $permission->name);
            $module = count($parts) > 1 ? $parts[0] : 'Others';
            return in_array($module, $basicSettingsModules);
        })->groupBy(function($permission) {
            $parts = explode('.', $permission->name);
            return count($parts) > 1 ? $parts[0] : 'Others';
        });

        $instituteSettingsGroups = $permissions->filter(function($permission) use ($instituteSettingsModules) {
            $parts = explode('.', $permission->name);
            $module = count($parts) > 1 ? $parts[0] : 'Others';
            return in_array($module, $instituteSettingsModules);
        })->groupBy(function($permission) {
            $parts = explode('.', $permission->name);
            return count($parts) > 1 ? $parts[0] : 'Others';
        });

        return view('backend.pages.role.index', compact('roles', 'permissionGroups', 'basicSettingsGroups', 'instituteSettingsGroups'))->with(['title' => 'Role Management', 'page' => 'role']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->guardSuperadmin();
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
        ]);
        $role = Role::create(['name' => $request->name]);
        
        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions);
        }

        session()->flash("success", "Role Created with Permissions Successfully");
        return redirect(route('role.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->guardSuperadmin();
        $role = Role::with('permissions')->find($id);
        $roles = Role::with('permissions')->paginate(10);
        $permissions = Permission::all();
        
        $basicSettingsModules = [
            'city_corporation', 'city_corporation_ward', 'city-corporation', 'city-corporation-ward',
            'family_category', 'family_subcategory', 'family_type',
            'house_category', 'house_ownership_type', 'house_type', 'house_class', 'house_owner_type',
            'land_class', 'land_ownership_type', 'land_type',
            'organization_category', 'organization_subcategory', 'organization_type', 'organization_work_area', 'organization_class', 'organization_owenership_type', 'organization_ownership_type',
            'profession', 'profession_category', 'profession_subcategory', 'profession_type',
            'road_category', 'road_owner', 'road_type',
            'union', 'union_ward',
            'vehicle_category', 'vehicle_subcategory', 'vehicle_type',
            'village', 'village_area',
            'reserve_ward', 'reserve-ward',
            'market', 'market_category', 'market_ownership_type', 'market_type',
            'bank', 'account_type', 'country',
            'basic-settings', 'basic_settings'
        ];

        $instituteSettingsModules = [
            'institute', 'institute_category', 'institute_type',
        ];

        $permissionGroups = $permissions->filter(function($permission) use ($basicSettingsModules, $instituteSettingsModules) {
            $parts = explode('.', $permission->name);
            $module = count($parts) > 1 ? $parts[0] : 'Others';
            return !in_array($module, $basicSettingsModules) && !in_array($module, $instituteSettingsModules);
        })->groupBy(function($permission) {
            $parts = explode('.', $permission->name);
            return count($parts) > 1 ? $parts[0] : 'Others';
        });

        $basicSettingsGroups = $permissions->filter(function($permission) use ($basicSettingsModules) {
            $parts = explode('.', $permission->name);
            $module = count($parts) > 1 ? $parts[0] : 'Others';
            return in_array($module, $basicSettingsModules);
        })->groupBy(function($permission) {
            $parts = explode('.', $permission->name);
            return count($parts) > 1 ? $parts[0] : 'Others';
        });

        $instituteSettingsGroups = $permissions->filter(function($permission) use ($instituteSettingsModules) {
            $parts = explode('.', $permission->name);
            $module = count($parts) > 1 ? $parts[0] : 'Others';
            return in_array($module, $instituteSettingsModules);
        })->groupBy(function($permission) {
            $parts = explode('.', $permission->name);
            return count($parts) > 1 ? $parts[0] : 'Others';
        });

        return view('backend.pages.role.index', compact('role', 'roles', 'permissionGroups', 'basicSettingsGroups', 'instituteSettingsGroups'))->with('title', 'Edit Role Type')->with('page', 'role');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->guardSuperadmin();
        $this->validate($request, [
            'name' => 'required|unique:roles,name,' . $id,
        ]);
        $role = Role::find($id);
        $role->name = $request->name;
        $role->save();

        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions);
        } else {
            $role->syncPermissions([]);
        }

        session()->flash("success", "Role Updated with Permissions Successfully");
        return redirect(route('role.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->guardSuperadmin();
        $role = Role::find($id);
        if ($role) {
            $role->delete();
            session()->flash("success", "Role Decommissioned Successfully");
        }
        return redirect(route('role.index'));
    }
}
