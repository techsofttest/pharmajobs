<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PharmaCompanySeeder extends Seeder
{
    public function run(): void
    {
        $filePath = database_path('seeders/data/companies.csv');

        if (!file_exists($filePath)) {
            $this->command->error("CSV file not found!");
            return;
        }

        $handle = fopen($filePath, 'r');

        DB::beginTransaction();

        try {
            $processed = [];

            while (($row = fgetcsv($handle, 2000, ',')) !== false) {

                foreach ($row as $cell) {

                    // Clean value
                    $name = trim($cell);
                    $name = preg_replace('/\s+/', ' ', $name);

                    if (empty($name)) {
                        continue;
                    }

                    // Prevent duplicate processing in same CSV
                    if (in_array(strtolower($name), $processed)) {
                        continue;
                    }

                    $processed[] = strtolower($name);

                    // Generate unique slug
                    $slug = Str::slug($name);
                    $originalSlug = $slug;
                    $count = 1;

                    while (DB::table('companies')->where('slug', $slug)->exists()) {
                        $slug = $originalSlug . '-' . $count++;
                    }

                    DB::table('companies')->updateOrInsert(
                        ['name' => $name],
                        [
                            'slug' => $slug,
                            'is_active' => 1,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]
                    );
                }
            }

            fclose($handle);
            DB::commit();

            $this->command->info('Companies imported successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            fclose($handle);

            $this->command->error('Error: ' . $e->getMessage());
        }
    }
}