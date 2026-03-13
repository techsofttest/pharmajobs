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
        
        Schema::create('employee_locations', function (Blueprint $table) {

        $table->id();

        $table->foreignId('profile_employee_id')
              ->constrained('profile_employees')
              ->cascadeOnDelete();

        $table->foreignId('district_id')
              ->constrained('districts')
              ->cascadeOnDelete();

        $table->timestamps();
        
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_locations');
    }
};
