<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('profile_employees', function (Blueprint $table) {

            // 1️⃣ Drop the foreign key first
            $table->dropForeign('profile_employees_designation_id_foreign');

            // 2️⃣ Drop the unique index
            $table->dropUnique('profile_employees_designation_id_unique');

            // 3️⃣ Recreate the foreign key (without unique)
            $table->foreign('designation_id')
                ->references('id')
                ->on('designations')
                ->cascadeOnDelete();

        });
    }

    public function down(): void
    {
        Schema::table('profile_employees', function (Blueprint $table) {

            $table->dropForeign('profile_employees_designation_id_foreign');

            $table->unique('designation_id');

            $table->foreign('designation_id')
                ->references('id')
                ->on('designations')
                ->cascadeOnDelete();

        });
    }
};