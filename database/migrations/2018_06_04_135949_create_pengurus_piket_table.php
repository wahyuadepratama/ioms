<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePengurusPiketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengurus_piket', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_anggota')->unsigned()->index();
            $table->foreign('id_anggota')->references('id')->on('anggota')->onDelete('cascade')->onUpdate('cascade');
            $table->string('jadwal_piket');
            $table->integer('total_denda');
            $table->unique(['id_anggota', 'jadwal_piket']);
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
        Schema::dropIfExists('pengurus_piket');
    }
}
