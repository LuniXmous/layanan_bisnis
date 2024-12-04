<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('extra_applications', function (Blueprint $table) {
            $table->text('note')->nullable()->after('approve_status'); // Tambahkan kolom note
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('extra_applications', function (Blueprint $table) {
            $table->dropColumn('note'); // Hapus kolom saat rollback
        });
    }
};
