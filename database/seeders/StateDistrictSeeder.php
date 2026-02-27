<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Models\State;
use App\Models\District;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StateDistrictSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {

            $path = database_path('seeders/data/india_states_districts.json');

            if (!File::exists($path)) {
                throw new \Exception('JSON file not found.');
            }

            $json = File::get($path);
            $rows = json_decode($json, true);


            $stateCache = [];

            foreach ($rows as $row) {

                $stateName = trim($row['State']);
                $slug = Str::slug($stateName);
                $districtName = trim($row['District']);

                if (!$stateName || !$districtName) continue;

                // Create state only once
                if (!isset($stateCache[$stateName])) {
                    $stateCache[$stateName] = State::firstOrCreate([
                        'name' => $stateName,
                        'slug' => $slug,
                    ]);
                }

                District::firstOrCreate([
                    'state_id' => $stateCache[$stateName]->id,
                    'name' => $districtName,
                    'slug' => Str::slug($districtName)
                ]);
            }

        });

        $this->command->info('States and Districts Seeded Successfully!');
    }
}