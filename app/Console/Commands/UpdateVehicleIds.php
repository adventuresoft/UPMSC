<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Vehicle;
use App\Models\Institute;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class UpdateVehicleIds extends Command
{
    protected $signature = 'vehicle:update-ids';
    protected $description = 'Update existing vehicle records with custom registration IDs';

    public function handle()
    {
        $vehicles = Vehicle::whereNull('registration_id')->get();
        $this->info("Found " . $vehicles->count() . " vehicles to update.");

        $categoryMap = [
            'Rickshaw - রিকশা' => '01',
            'Van - ভ্যান / ভ্যানগাড়ি' => '02',
            'Thela Gari - ঠেলাগাড়ি' => '03',
            'Gorur Gari - গরুর গাড়ি' => '04',
        ];

        $institute = Institute::whereNotNull('union_id')->first();
        $unionId = $institute ? $institute->union_id : '1850';
        $unionId = str_pad($unionId, 4, '0', STR_PAD_LEFT);

        foreach ($vehicles as $vehicle) {
            $year = $vehicle->created_at ? $vehicle->created_at->format('y') : date('y');
            $catCode = $categoryMap[$vehicle->vehicle_category] ?? '00';
            
            $prefix = "{$year}-{$unionId}-{$catCode}";
            
            $registrationId = IdGenerator::generate([
                'table' => 'vehicles',
                'field' => 'registration_id',
                'length' => 14,
                'prefix' => $prefix
            ]);

            $vehicle->registration_id = $registrationId;
            $vehicle->save();
            
            $this->info("Updated Vehicle ID {$vehicle->id} to {$registrationId}");
        }

        $this->info("Done!");
    }
}
