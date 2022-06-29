<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThresholdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('threshold', function (Blueprint $table) {
            // Create Table
            $table->id();
            $table->unsignedBigInteger('stasiun_id');
            $table->float('rc_batasatas_suspect_suhu')->default(0);
            $table->float('rc_batasbawah_suspect_suhu')->default(0);
            $table->float('rc_batasatas_suspect_kelembapan')->default(0);
            $table->float('rc_batasbawah_suspect_kelembapan')->default(0);
            $table->float('rc_batasatas_suspect_tekanan')->default(0);
            $table->float('rc_batasbawah_suspect_tekanan')->default(0);
            $table->float('sc_batasatas_suspect_suhu')->default(0);
            $table->float('sc_batasbawah_suspect_suhu')->default(0);
            $table->float('sc_batasatas_suspect_kelembapan')->default(0);
            $table->float('sc_batasbawah_suspect_kelembapan')->default(0);
            $table->float('sc_batasatas_suspect_tekanan')->default(0);
            $table->float('sc_batasbawah_suspect_tekanan')->default(0);

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
        Schema::dropIfExists('threshold');
    }
}
