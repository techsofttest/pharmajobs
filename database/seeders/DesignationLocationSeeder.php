<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Location;

class DesignationLocationSeeder extends Seeder
{
    public function run(): void
    {
        $file = database_path('seeders/data/managerlocations.csv');

        if (!file_exists($file)) {
            $this->command->error('CSV not found');
            return;
        }

        // Designations you want to map
        $designationIds = [
            8,
            11,
            12,
            13,
            14,
            15,
            16,
            17
        ];

        $rows = array_map('str_getcsv', file($file));

        foreach ($rows as $row) {

            foreach ($row as $locationName) {

                $locationName = trim($locationName);

                if (!$locationName) {
                    continue;
                }

                $location = Location::where('name', $locationName)->first();

                if (!$location) {
                    continue;
                }

                foreach ($designationIds as $designationId) {

                    DB::table('designation_locations')->updateOrInsert([
                        'designation_id' => $designationId,
                        'location_id' => $location->id
                    ]);
                }
            }
        }

        $this->command->info('Locations mapped to designations successfully.');
    }
}