<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Standard actions for every module
        $actions = ['read', 'create', 'update', 'delete'];

        // Comprehensive module list from sidebar/web.php
        $modules = [
            // System & Access
            'basic-settings',
            'dashboard',
            'user',
            'role',
            'permission',
            'institute',
            'institute_category',
            'institute_type',
            'institutional-admin',

            // People
            'people',
            'people_credentials',
            'applicant_list',
            'reg_people_list',
            'search_people',

            // Certificate (all types share this module)
            'certificate',
            'age_certificate', 'character_certificate', 'childless_certificate', 'citizen_certificate',
            'disability_certificate', 'financial_instability_certificate', 'guardian_certificate',
            'landless_certificate', 'married_certificate', 'name_certificate', 'nid_correction_certificate',
            'orphan_certificate', 'permanent_citizen_certificate', 'remarried_certificate',
            'residential_certificate', 'unmarried_certificate', 'voter_area_certificate',
            'voter_list_certificate', 'yearly_income_certificate',
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
            'power_of_attorney', 'power-of-attorney', 'ethnic_minority', 'ethnic-minority', 'tribal', 'indigenous',

            // Organization & Trade
            'organization',
            'organization_transfer',
            'trade_license',
            'applicant_org_list',
            'approved_org_list',
            'org_fees',
            'org_generate_invoice',

            // Physical assets
            'house',
            'land',
            'vehicle',
            'vehicle_application_list',
            'vehicle_fees_new',
            'vehicle_fees_list',
            'road',
            'market',
            'bridge',

            // Tax
            'tax',
            'tax_generate',
            'tax_list',
            'tax_received',

            // Civil registry
            'marriage',
            'divorce',

            // Local governance
            'chairman',
            'chairman_list',
            'member_list',
            'reserve_member_list',
            'panel_list',
            'councilor',
            'village_court',
            'relief_card',

            // Basic Settings sub-modules
            'city_corporation',
            'city_corporation_ward',
            'family_category',
            'family_subcategory',
            'family_type',
            'house_ownership_type',
            'house_type',
            'house_category',
            'house_class',
            'house_owner_type',
            'land_type',
            'land_class',
            'land_ownership_type',
            'organization_category',
            'organization_subcategory',
            'organization_subtype',
            'organization_work_area',
            'organization_type',
            'organization_class',
            'organization_ownership_type',
            'post_office',
            'profession',
            'profession_category',
            'profession_subcategory',
            'profession_type',
            'road_category',
            'road_type',
            'road_owner',
            'reserve_ward',
            'vehicle_category',
            'vehicle_subcategory',
            'vehicle_type',
            'union_ward',
            'union',
            'village',
            'village_area',
            'country',
            'market_type',
            'market_category',
            'market_ownership_type',
        ];

        foreach ($modules as $module) {
            foreach ($actions as $action) {
                $permissionName = $module . '.' . $action;
                Permission::firstOrCreate([
                    'name' => $permissionName,
                    'guard_name' => 'web'
                ]);
            }
        }

        // Assign all permissions to Superadmin (Role 1) and Developer (Role 4)
        $superAdminRole = Role::find(1);
        $developerRole = Role::find(4);

        $allPermissions = Permission::all();

        if ($superAdminRole) {
            $superAdminRole->syncPermissions($allPermissions);
        }

        if ($developerRole) {
            $developerRole->syncPermissions($allPermissions);
        }
    }
}
