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
        Schema::create('job_postings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->cascadeOnDelete();
            $table->foreignId('designation_id')->constrained()->cascadeOnDelete();

            $table->string('job_id')->unique()->nullable();

            $table->string('title');
            $table->text('description');
            $table->string('qualification');

            $table->string('contact_name');
            $table->string('contact_email');
            $table->string('contact_phone');

            $table->integer('min_experience')->nullable();
            $table->integer('max_experience')->nullable();
            $table->integer('max_age')->nullable();

            $table->date('expires_at')->nullable();

            $table->boolean('is_active')->default(true);

            $table->nullableMorphs('created_by');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_postings');
    }
};
