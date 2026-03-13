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
        Schema::table('profiles', function (Blueprint $table) {
        // Drop foreign key first
        $table->dropForeign('profiles_district_id_foreign');

        // Then drop column
        $table->dropColumn('district_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
           $table->foreignId('district_id')
              ->constrained()
              ->cascadeOnDelete();
        });
    }
};
