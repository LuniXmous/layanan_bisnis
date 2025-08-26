<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Hapus constraint lama, lalu buat ulang enum
        DB::statement("ALTER TABLE applications DROP CONSTRAINT IF EXISTS applications_income_check");

        Schema::table('applications', function (Blueprint $table) {
            $table->enum('income', ['income_generate', 'non_income_generate'])
                  ->nullable()
                  ->change();
        });
    }

    public function down(): void
    {
        // Rollback ke default lama (misalnya hanya income_generate)
        DB::statement("ALTER TABLE applications DROP CONSTRAINT IF EXISTS applications_income_check");

        Schema::table('applications', function (Blueprint $table) {
            $table->enum('income', ['income', 'non_income'])->nullable()->change();
        });
    }
};
