<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data', function (Blueprint $table) {
            // Create Table
            $table->id();
            $table->unsignedBigInteger('stasiun_id');
            $table->dateTime('waktu');
            $table->float('data_suhu')->nullable();
            $table->float('data_kelembapan')->nullable();
            $table->float('data_tekanan')->nullable();
            $table->string('hasil_rc_suhu', 10);
            $table->string('hasil_rc_kelembapan', 10);
            $table->string('hasil_rc_tekanan', 10);
            $table->string('hasil_sc_suhu', 10);
            $table->string('hasil_sc_kelembapan', 10);
            $table->string('hasil_sc_tekanan', 10);

            // Indexes
            $table->foreign('stasiun_id')->references('id')->on('stasiun');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data');
    }
}
