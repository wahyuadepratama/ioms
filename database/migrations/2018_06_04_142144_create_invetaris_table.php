<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvetarisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invetaris', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->integer('id_jenis')->unsigned()->index();
            $table->foreign('id_jenis')->references('id')->on('jenis_invetaris')->onDelete('cascade')->onUpdate('cascade');
            $table->string('status')->default('Tersedia');
            $table->string('kondisi')->default('Baik');
            $table->string('keterangan')->nullable();
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
        Schema::dropIfExists('invetaris');
    }
}
