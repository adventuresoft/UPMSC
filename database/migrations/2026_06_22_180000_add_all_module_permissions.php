<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\Permission;
use App\Models\Role;

class AddAllModulePermissions extends Migration
{
    /**
     * Add permissions for all modules not yet covered.
     */
    public function up()
    {
        $actions = ['read', 'create', 'update', 'delete'];

        $modules = [
            // Core modules missing from earlier migrations
            'succession',
            'inheritance',
            'village_court',
            'relief_card',
            'organization_transfer',
            'people_credentials',
            // Some basic-settings modules not in original list
            'bank',
            'account_type',
            'house_owner_type',
            'organization_class',
            'organization_subtype',
            'vehicle_subcategory',
            'market_type',
            'market_category',
            'market_ownership_type',
            'country',
            // Re-ensure all certificate types
            'certificate',
            'birth_certificate',
            'death_certificate',
            'succession_certificate',
            'inheritance_certificate',
            // Re-ensure all main modules
            'dashboard',
            'people',
            'organization',
            'trade_license',
            'house',
            'land',
            'vehicle',
            'road',
            'tax',
            'marriage',
            'divorce',
            'chairman',
            'councilor',
            'institute',
            'institute_category',
            'institute_type',
            'user',
            'role',
            'permission',
            'market',
            'bridge',
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
        $developerRole  = Role::find(4);

        $allPermissions = Permission::all();

        if ($superAdminRole) {
            $superAdminRole->syncPermissions($allPermissions);
        }

        if ($developerRole) {
            $developerRole->syncPermissions($allPermissions);
        }
    }

    public function down()
    {
        // No rollback needed for permission additions
    }
}
