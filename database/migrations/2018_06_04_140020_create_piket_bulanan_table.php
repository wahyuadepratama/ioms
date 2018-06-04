<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePiketBulananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('piket_bulanan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_pengurus_posting')->unsigned()->index();
            $table->foreign('id_pengurus_posting')->references('id')->on('pengurus_posting')->onDelete('cascade')->onUpdate('cascade');
            $table->string('keterangan');
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
        Schema::dropIfExists('piket_bulanan');
    }
}
