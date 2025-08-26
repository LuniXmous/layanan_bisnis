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
            // tambahkan kolom income jika belum ada
            if (!Schema::hasColumn('applications', 'income')) {
                $table->enum('income', ['Income', 'Non Income'])
                      ->nullable()
                      ->after('status'); // letakkan setelah kolom status (atau sesuaikan)
            }
        });

        // Tambahkan constraint check manual untuk PostgreSQL
        DB::statement("ALTER TABLE applications 
                       ADD CONSTRAINT applications_income_check 
                       CHECK (income IN ('Income', 'Non Income'));");
    }

    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            if (Schema::hasColumn('applications', 'income')) {
                $table->dropColumn('income');
            }
        });
    }
};
