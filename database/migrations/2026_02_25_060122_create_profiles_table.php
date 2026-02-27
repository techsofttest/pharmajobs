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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();

            $table->foreignId('district_id')->constrained()->cascadeOnDelete();
                  
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('password');

            $table->enum('role', ['employee', 'employer']);

            $table->boolean('is_active')->default(true);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }

};
