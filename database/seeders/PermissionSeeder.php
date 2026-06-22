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

            // Certificate (all types share this module)
            'certificate',

            // Organization & Trade
            'organization',
            'organization_transfer',
            'trade_license',

            // Physical assets
            'house',
            'land',
            'vehicle',
            'road',
            'market',
            'bridge',

            // Tax
            'tax',

            // Civil registry
            'marriage',
            'divorce',

            // Local governance
            'chairman',
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
