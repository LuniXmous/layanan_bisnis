<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationStatusLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('application_status_logs', function (Blueprint $table) {
        $table->id();
        $table->foreignUuid('application_id');
        $table->integer('approve_status');
        $table->foreignUuid('user_id');
        $table->foreignId('role_id');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('application_status_logs');
    }
}

