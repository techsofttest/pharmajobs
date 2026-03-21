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
        Schema::create('designation_locations', function (Blueprint $table) {
        $table->id();
        $table->foreignId('designation_id')->constrained('designations')->cascadeOnDelete();
        $table->foreignId('location_id')->constrained('locations')->cascadeOnDelete();
        $table->unique(['designation_id', 'location_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('designation_locations');
    }
};
