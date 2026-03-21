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

        Schema::table('locations', function (Blueprint $table) {
            // Drop foreign key first
            $table->dropForeign('districts_state_id_foreign');
        });

        Schema::table('locations', function (Blueprint $table) {
            // Make column nullable
            $table->foreignId('state_id')->nullable()->change();
        });

        Schema::table('locations', function (Blueprint $table) {
            // Re-add foreign key
            $table->foreign('state_id')
                ->references('id')
                ->on('states')
                ->nullOnDelete();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('locations', function (Blueprint $table) {
            $table->dropForeign('districts_state_id_foreign');
        });

        Schema::table('locations', function (Blueprint $table) {
            $table->foreignId('state_id')->nullable(false)->change();
        });

        Schema::table('locations', function (Blueprint $table) {
            $table->foreign('state_id')
                ->references('id')
                ->on('states')
                ->cascadeOnDelete();
        });
    }
};
