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

        Schema::table('profile_employees', function (Blueprint $table) {


       // Drop foreign keys first
        $table->dropForeign('profile_employees_district_id_foreign');

        // Drop unique indexes
        $table->dropUnique('profile_employees_district_id_unique');

        // Drop unnecessary columns
        $table->dropColumn(['district_id']);

        // Add new f
        // ields
        $table->foreignId('category_id')
              ->after('profile_id')
              ->constrained('categories');

        $table->text('speciality')->nullable()->after('category_id');

        // Re-add foreign for designation without unique
        $table->foreign('designation_id')
              ->references('id')
              ->on('designations')
              ->cascadeOnDelete();

        
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         // Drop new foreign keys
        $table->dropForeign(['category_id']);
        $table->dropForeign(['designation_id']);

        // Drop new columns
        $table->dropColumn(['category_id', 'age', 'speciality']);

        // Re-add old columns
        $table->foreignId('district_id')
              ->unique()
              ->constrained('districts');

        $table->foreignId('company_id')
              ->unique()
              ->constrained('companies');

        // Re-add designation unique constraint
        $table->unique('designation_id');

        // Re-add foreign key for designation
        $table->foreign('designation_id')
              ->references('id')
              ->on('designations');
    }
};
