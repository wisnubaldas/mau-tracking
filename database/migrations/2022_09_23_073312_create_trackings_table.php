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
        Schema::create('trackings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('status_trackings_id');
            $table->string('no_aju');
            $table->string('mawb');
            $table->string('hawb');
            $table->string('air_lines');
            $table->string('flight');
            $table->string('shipper');
            $table->string('alamat');
            $table->string('notify');
            $table->string('kd_gudang');
            $table->date('status_date');
            $table->time('status_time');
            $table->timestamps();
            $table->index(['no_aju', 'mawb','hawb']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trackings');
    }
};
