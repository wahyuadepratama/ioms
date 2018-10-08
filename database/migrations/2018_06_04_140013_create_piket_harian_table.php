<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePiketHarianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('piket_harian', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_pengurus_piket')->unsigned()->index();
            $table->foreign('id_pengurus_piket')->references('id')->on('pengurus_piket')->onDelete('cascade')->onUpdate('cascade');
            $table->string('keterangan')->nullable();
            $table->integer('denda');
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
        Schema::dropIfExists('piket_harian');
    }
}
