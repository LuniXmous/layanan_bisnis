<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            if (!Schema::hasColumn('applications', 'income')) {
                $table->string('income') // gunakan string, enum diganti check constraint
                      ->nullable()
                      ->after('status');
            }
        });

        // Tambahkan constraint check untuk PostgreSQL
        DB::statement("
            ALTER TABLE applications
            ADD CONSTRAINT applications_income_check
            CHECK (income IN ('income_generate', 'non_income_generate'))
        ");
    }

    public function down(): void
    {
        // Drop constraint dulu sebelum drop column
        DB::statement("ALTER TABLE applications DROP CONSTRAINT IF EXISTS applications_income_check");

        Schema::table('applications', function (Blueprint $table) {
            if (Schema::hasColumn('applications', 'income')) {
                $table->dropColumn('income');
            }
        });
    }
};
