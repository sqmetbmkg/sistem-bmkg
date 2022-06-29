<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStasiunTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stasiun', function (Blueprint $table) {
            // Create Table
            $table->id();
            $table->unsignedInteger('wmo_id');
            $table->string('nama_stasiun', 100);
            $table->string('nama_balai', 100);
            $table->string('provinsi', 100);
            $table->float('longitude');
            $table->float('latitude');
            $table->integer('elevation_mdpl');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stasiun');
    }
}
