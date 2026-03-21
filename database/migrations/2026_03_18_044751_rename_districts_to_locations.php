<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

         // Rename main table
        Schema::rename('districts', 'locations');

        Schema::rename('district_job', 'job_posting_locations');

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

       Schema::rename('locations', 'districts');

       Schema::rename('job_posting_locations', 'district_job');

    }
};
