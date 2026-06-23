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
    
    private function getGroupedPermissions() {
        $permissions = Permission::all();
        
        $sidebarMapping = [
            'Dashboard' => ['dashboard'],
            'Basic Settings' => [
                'city_corporation', 'city_corporation_ward', 'city-corporation', 'city-corporation-ward',
                'family_category', 'family_subcategory', 'family_type',
                'house_category', 'house_ownership_type', 'house_type', 'house_class', 'house_owner_type',
                'land_class', 'land_ownership_type', 'land_type',
                'organization_category', 'organization_subcategory', 'organization_type', 'organization_work_area', 'organization_class', 'organization_owenership_type', 'organization_ownership_type',
                'profession', 'profession_category', 'profession_subcategory', 'profession_type',
                'road_category', 'road_owner', 'road_type',
                'union', 'union_ward', 'post_office', 'post-office',
                'vehicle_category', 'vehicle_subcategory', 'vehicle_type',
                'village', 'village_area',
                'reserve_ward', 'reserve-ward',
                'market', 'market_category', 'market_ownership_type', 'market_type',
                'bank', 'account_type', 'country',
                'basic-settings', 'basic_settings'
            ],
            'Access Management' => ['role', 'permission', 'user'],
            'Institute Settings' => ['institute', 'institute_category', 'institute_type'],
            'Institutional Admins' => ['institutional-admin', 'institutional_admin'],
            'People Info' => ['people'],
            'Certificate' => [
                'certificate',
                'age_certificate', 'character_certificate', 'childless_certificate', 'citizen_certificate',
                'disability_certificate', 'financial_instability_certificate', 'guardian_certificate',
                'landless_certificate', 'married_certificate', 'name_certificate', 'nid_correction_certificate',
                'orphan_certificate', 'permanent_citizen_certificate', 'remarried_certificate',
                'residential_certificate', 'unmarried_certificate', 'voter_area_certificate',
                'voter_list_certificate', 'yearly_income_certificate',
                // Keep the original variants
                'citizen', 'character', 'death', 'succession', 'unmarried', 'married', 'remarried', 'landless',
                'name', 'income', 'disability-certificate', 'voter_area', 'voter-area',
                'voter_list', 'voter-list', 'nid_correction', 'nid-correction', 'childless', 'orphan',
                'financial_instability', 'financial-instability', 'age',
                'permanent_citizen', 'permanent-citizen', 'residential', 'guardian_income', 'guardian-income',
                'guardian_acceptance', 'guardian-acceptance', 'inheritance', 'birth_registration_correction',
                'birth-registration-correction', 'new_voter_recommendation', 'new-voter-recommendation',
                'voter_registration_agreement', 'voter-registration-agreement', 'not_rohingya', 'not-rohingya',
                'passport_related', 'passport-related', 'family', 'alive', 'missing_person', 'missing-person',
                'abandoned_by_husband', 'abandoned-by-husband', 'widow', 'dependency', 'dowryless',
                'unemployment', 'helplessness', 'illiteracy', 'agriculture', 'fisherman', 'professional',
                'farmer_fuel_oil_card', 'farmer-fuel-oil-card', 'no_objection', 'no-objection', 'general',
                'infrastructure_construction_permission', 'infrastructure-construction-permission',
                'power_of_attorney', 'power-of-attorney', 'ethnic_minority', 'ethnic-minority', 'tribal', 'indigenous'
            ],
            'Organization' => ['organization', 'trade_license'],
            'Tax' => ['tax', 'taxes'],
            'Relief Card' => ['relief_card', 'relief-card'],
            'House Info' => ['house'],
            'Land Info' => ['land'],
            'Vehicle Info' => ['vehicle'],
            'Local Govt. Judiciary' => ['village_court', 'village-court'],
            'Road Info' => ['road', 'bridge'],
            'Market Info' => ['market_info'],
            'Marriage & Divorce' => ['marriage', 'divorce'],
            'Chairman & Members Info' => ['chairman', 'councilor', 'member', 'reserve_member', 'panel'],
        ];

        $grouped = [];

        // Initialize structure
        foreach ($sidebarMapping as $category => $modules) {
            $grouped[$category] = [];
        }
        $grouped['Other Modules'] = [];

        foreach ($permissions as $permission) {
            $parts = explode('.', $permission->name);
            $moduleName = count($parts) > 1 ? $parts[0] : 'others';
            
            $foundCategory = 'Other Modules';
            foreach ($sidebarMapping as $category => $modules) {
                if (in_array($moduleName, $modules)) {
                    $foundCategory = $category;
                    break;
                }
            }

            if (!isset($grouped[$foundCategory][$moduleName])) {
                $grouped[$foundCategory][$moduleName] = collect();
            }
            $grouped[$foundCategory][$moduleName]->push($permission);
        }

        // Remove empty categories
        foreach ($grouped as $key => $val) {
            if (empty($val)) {
                unset($grouped[$key]);
            }
        }

        return collect($grouped);
    }
    
    public function index()
    {
        $this->guardSuperadmin();
        $roles = Role::with('permissions')->paginate(10);
        $sidebarGroups = $this->getGroupedPermissions();

        return view('backend.pages.role.index', compact('roles', 'sidebarGroups'))->with(['title' => 'Role Management', 'page' => 'role']);
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
        $sidebarGroups = $this->getGroupedPermissions();

        return view('backend.pages.role.index', compact('role', 'roles', 'sidebarGroups'))->with('title', 'Edit Role Type')->with('page', 'role');
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
