<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeminjamanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_peminjam')->unsigned()->index();
            $table->foreign('id_peminjam')->references('id')->on('peminjam')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('id_inventaris')->unsigned()->index();
            $table->foreign('id_inventaris')->references('id')->on('inventaris')->onDelete('cascade')->onUpdate('cascade');
            $table->string('durasi');
            $table->boolean('active');
            $table->datetime('tanggal_pinjam');
            $table->datetime('tanggal_kembali')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peminjaman');
    }
}
