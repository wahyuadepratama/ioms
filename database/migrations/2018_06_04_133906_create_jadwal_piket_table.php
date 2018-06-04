<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJadwalPiketTable extends Migration
{

    public function up()
    {
        Schema::create('jadwal_piket', function (Blueprint $table) {
            $table->increments('id');
            $table->string('hari')->default('Tidak ada jadwal piket');          
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jadwal_piket');
    }
}
