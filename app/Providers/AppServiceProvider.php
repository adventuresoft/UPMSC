<?php

namespace App\Providers;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Load custom global helper files so functions like imageUrl() are always available.
        foreach (glob(app_path('Helpers') . '/*.php') as $helper) {
            require_once $helper;
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
         Paginator::useBootstrap();
        Schema::defaultStringLength(191);
        
        // Dynamically apply area-based multitenancy global scope to all basic settings models
        $basicSettingsModels = [
            \App\Models\BasicSettings\AccountType::class,
            \App\Models\BasicSettings\Bank::class,
            \App\Models\BasicSettings\FamilyCategory::class,
            \App\Models\BasicSettings\FamilySubCategory::class,
            \App\Models\BasicSettings\FamilyType::class,
            \App\Models\BasicSettings\HouseCategory::class,
            \App\Models\BasicSettings\HouseClass::class,
            \App\Models\BasicSettings\HouseOwnerType::class,
            \App\Models\BasicSettings\HouseType::class,
            \App\Models\BasicSettings\LandClass::class,
            \App\Models\BasicSettings\LandOwnershipType::class,
            \App\Models\BasicSettings\LandType::class,
            \App\Models\BasicSettings\MarketCategory::class,
            \App\Models\BasicSettings\MarketOwnershipType::class,
            \App\Models\BasicSettings\MarketType::class,
            \App\Models\BasicSettings\OrganizationCategory::class,
            \App\Models\BasicSettings\OrganizationClass::class,
            \App\Models\BasicSettings\OrganizationOwenershipType::class,
            \App\Models\BasicSettings\OrganizationOwnershipType::class,
            \App\Models\BasicSettings\OrganizationSubCategory::class,
            \App\Models\BasicSettings\OrganizationType::class,
            \App\Models\BasicSettings\OrganizationWorkArea::class,
            \App\Models\BasicSettings\Profession::class,
            \App\Models\BasicSettings\ProfessionCategory::class,
            \App\Models\BasicSettings\ProfessionSubCategory::class,
            \App\Models\BasicSettings\ProfessionType::class,
            \App\Models\BasicSettings\ReserveWard::class,
            \App\Models\BasicSettings\RoadCategory::class,
            \App\Models\BasicSettings\RoadType::class,
            \App\Models\BasicSettings\VehicleCategory::class,
            \App\Models\BasicSettings\VehicleSubCategory::class,
            \App\Models\BasicSettings\VehicleType::class,
            \App\Models\BasicSettings\Village::class,
            \App\Models\VillageArea::class,
            \App\Models\CityCorporationWard::class,
            \App\Models\UnionWard::class,
        ];

        foreach ($basicSettingsModels as $modelClass) {
            if (class_exists($modelClass)) {
                $modelClass::addGlobalScope(new \App\Scopes\AreaMultitenancyScope());
            }
        }
    }
}
