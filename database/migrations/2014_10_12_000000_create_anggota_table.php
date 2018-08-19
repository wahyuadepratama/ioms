<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateAnggotaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anggota', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('nim')->unique();
            $table->string('no_anggota')->unique()->nullable();
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('no_handphone')->nullable();
            $table->string('alamat')->nullable();
            $table->string('kutipan')->nullable();
            $table->string('password');
            $table->string('avatar')->default('default.png');
            $table->integer('id_role')->unsigned()->index();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('anggota');
    }
}
