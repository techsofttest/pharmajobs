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
        Schema::create('profile_employees', function (Blueprint $table) {
            $table->id();

            $table->foreignId('profile_id')
                  ->unique()
                  ->constrained('profiles')
                  ->cascadeOnDelete();
            $table->foreignId('designation_id')
                  ->unique()
                  ->constrained('designations');
            $table->foreignId('district_id')
                  ->unique()
                  ->constrained('districts');
            $table->foreignId('company_id')
                  ->unique()
                  ->constrained('companies');
            $table->string('cv')->nullable();
            $table->integer('yoe')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_employees');
    }
};
