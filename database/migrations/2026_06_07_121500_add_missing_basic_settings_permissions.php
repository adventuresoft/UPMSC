<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\Permission;
use App\Models\Role;

class AddMissingBasicSettingsPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $modules = [
            'basic-settings',
            'city_corporation',
            'city_corporation_ward',
            'family_category',
            'family_subcategory',
            'family_type',
            'house_ownership_type',
            'house_type',
            'house_category',
            'land_type',
            'land_class',
            'land_ownership_type',
            'organization_category',
            'organization_subcategory',
            'organization_work_area',
            'organization_type',
            'organization_ownership_type',
            'post_office',
            'profession',
            'profession_type',
            'profession_category',
            'profession_subcategory',
            'road_category',
            'road_type',
            'road_owner',
            'reserve_ward',
            'union',
            'union_ward',
            'vehicle_category',
            'vehicle_type',
            'village',
            'village_area'
        ];

        $actions = ['read', 'create', 'update', 'delete'];

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

        if ($superAdminRole) {
            $allPermissions = Permission::all();
            $superAdminRole->syncPermissions($allPermissions);
        }

        if ($developerRole) {
            $allPermissions = Permission::all();
            $developerRole->syncPermissions($allPermissions);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // No rollback required for permission additions
    }
}
