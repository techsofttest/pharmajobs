<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {


    public function up(): void
    {
       
        Schema::table('job_posting_locations', function (Blueprint $table) {

        //$table->dropForeign('district_job_district_id_foreign');

        //$table->dropForeign('district_job_job_id_foreign');

        //$table->dropUnique('district_job_job_id_district_id_unique');

        //$table->dropIndex('district_job_district_id_foreign');

        });

        // 3️⃣ Rename col
        Schema::table('job_posting_locations', function (Blueprint $table) {
            //$table->renameColumn('district_id', 'location_id');
        });

        // 4️⃣ Recreate clean constraints
        Schema::table('job_posting_locations', function (Blueprint $table) {

            // FK → locations
            $table->foreign('location_id', 'job_location_location_id_foreign')
                ->references('id')
                ->on('locations')
                ->restrictOnDelete();

            // FK → jobs
            $table->foreign('job_id', 'job_location_job_id_foreign')
                ->references('id')
                ->on('job_postings')
                ->cascadeOnDelete();

            // Clean unique
            $table->unique(['job_id', 'location_id'], 'job_location_unique');

        });
    }

    public function down(): void
    {
        // Reverse everything

        Schema::table('job_posting_locations', function (Blueprint $table) {

        $table->dropForeign('job_location_location_id_foreign');

        $table->dropForeign('job_location_job_id_foreign');

        $table->dropUnique('job_location_unique');

        });
      

        Schema::table('job_posting_locations', function (Blueprint $table) {
            $table->renameColumn('location_id', 'district_id');
        });

        Schema::table('job_posting_locations', function (Blueprint $table) {

            $table->foreign('district_id', 'district_job_district_id_foreign')
                ->references('id')
                ->on('locations')
                ->restrictOnDelete();

            $table->foreign('job_id', 'district_job_job_id_foreign')
                ->references('id')
                ->on('job_postings')
                ->cascadeOnDelete();

            $table->unique(['job_id', 'district_id'], 'district_job_job_id_district_id_unique');
        });
    }
};