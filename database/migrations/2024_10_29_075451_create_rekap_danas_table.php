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
        Schema::create('rekap_danas', function (Blueprint $table) {
            $table->id();
            $table->uuid('extra_application_id');  // Ubah menjadi uuid
            $table->decimal('nominal', 15, 2);
            $table->timestamps();
        
            // Tambahkan foreign key
            $table->foreign('extra_application_id')->references('id')->on('extra_applications');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rekap_danas');
    }
};
