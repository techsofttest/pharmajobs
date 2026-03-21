<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Location;
use Illuminate\Support\Str;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        $file = database_path('seeders/data/alllocations.csv');

        if (!file_exists($file)) {
            $this->command->error('locations.csv not found');
            return;
        }

        $handle = fopen($file, 'r');

        $header = fgetcsv($handle); // skip header

        while (($row = fgetcsv($handle)) !== false) {

            $district = trim($row[0]); // first column

            // insert location
            $districtLocation = Location::firstOrCreate([
                'name' => $district
            ],[
                'slug' => Str::slug($district)
            ]);

            // remaining columns
            for ($i = 1; $i < count($row); $i++) {

                $area = trim($row[$i]);

                if (!$area) continue;

                Location::firstOrCreate([
                    'name' => $area
                ],[
                    'slug' => Str::slug($area)
                ]);
            }
        }

        fclose($handle);

        $this->command->info('Locations imported successfully.');
    }
}